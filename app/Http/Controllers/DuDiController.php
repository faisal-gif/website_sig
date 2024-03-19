<?php

namespace App\Http\Controllers;

use App\Models\DuDi;
use App\Models\Kerjasama;
use App\Models\PenanggungJawab;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DuDiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function countDudi()
    {
        return DuDi::count();
    }
    public function countProdi()
    {
        return Prodi::count();
    }
    public function countKerjasama()
    {
        return Kerjasama::count();
    }
    public function show()
    {
        return view("manage.kerjasama.index");
    }
    public function index()
    {
        $data = Kerjasama::select(['kerjasama.*', 'prodi.nama as prodi', 'dudi.nama as nama_dudi', 'dudi.nib as nib'])->join('prodi', 'kerjasama.prodi', '=', 'prodi.id')->join('dudi', 'kerjasama.dudi_id', '=', 'dudi.id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nib', function ($row) {
                return '0000' . $row->nib;
            })
            ->addColumn('item_kerjasama', function ($row) {
                $item_kerjasama = '<ul><li>Nama Perjanjian Kerjasama :' . $row->nama_pks . '</li>
                    <li>Nomor Perjanjian Kerjasama :' . $row->no_pks . '</li>
                    <li>Bidang Kerjasama :' . $row->bidang_kerjasama . '</li>
                    <li>Program Studi :' . $row->prodi . '</li>
                    <li>Mulai Perjanjian Kerjasama :' . $row->mulai_pks . '</li>
                    <li>Selesai Perjanjian Kerjasama :' . $row->selesai_pks . '</li></ul>';


                return $item_kerjasama;
            })
            ->addColumn('action', function ($row) {

                $mou = '<a href="' . asset('dokumen_mou/' . $row->dokumen_mou) . '" class="btn text-white btn-info btn-sm mt-1">MOU</a>';
                $pks = '<a href="' . asset('dokumen_pks/' . $row->dokumen_pks) . '" class="btn text-white btn-danger btn-sm mt-1">PKS</a>';

                return $mou . ' ' . $pks;
            })
            ->rawColumns(['action', 'item_kerjasama', 'nib'])
            ->make(true);

    }
    public function dudiNonNib()
    {
        return view('manage.dudi_non_nib.index');
    }
    public function dudiNonNibindex()
    {
        $data = DuDi::select('dudi.*', 'indonesia_provinces.name as provinsi', 'indonesia_cities.name as kota')->join('indonesia_provinces', 'dudi.provinsi', '=', 'indonesia_provinces.id')->join('indonesia_cities', 'dudi.kota', '=', 'indonesia_cities.id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit = '<a href="javascript:void(0)" id="editDudi" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editDudi"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteDudi"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'lingkup' => 'required|string',
            'email' => 'required|string|max:255',
            'no_telepon' => 'required|min:11',
            'sk_pendirian' => 'required',
            'kbli' => 'required',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $dudi = DuDi::create([
            'nama' => $request->nama,
            'kategori_mitra' => $request->kategori,
            'lingkup_kerjasama' => $request->lingkup,
            'email' => $request->email,
            'no_telp' => $request->no_telepon,
            'sk_pendirian' => $request->sk_pendirian,
            'kbli' => $request->kbli,
            'alamat' => $request->alamat,
            'provinsi' => $request->input('provinsi'),
            'kota' => $request->input('kota'),
            'kecamatan' => $request->input('kecamatan'),
            'kelurahan' => $request->input('kelurahan'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $dudi->id
        ]);
    }

    public function edit($id)
    {
        $data = DuDi::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'lingkup' => 'required|string',
            'email' => 'required|string|max:255',
            'no_telepon' => 'required|min:11',
            'sk_pendirian' => 'required',
            'kbli' => 'required',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $id = $request->id;
        $dudi = DuDi::findOrFail($id);

        $dudi->nama = $request->nama;
        $dudi->kategori_mitra = $request->kategori;
        $dudi->lingkup_kerjasama = $request->lingkup;
        $dudi->email = $request->email;
        $dudi->no_telp = $request->no_telepon;
        $dudi->sk_pendirian = $request->sk_pendirian;
        $dudi->kbli = $request->kbli;
        $dudi->alamat = $request->alamat;
        $dudi->provinsi = $request->input('provinsi');
        $dudi->kota = $request->input('kota');
        $dudi->kecamatan = $request->input('kecamatan');
        $dudi->kelurahan = $request->input('kelurahan');

        $dudi->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah',
        ]);

    }


}
