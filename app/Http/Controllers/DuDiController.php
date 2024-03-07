<?php

namespace App\Http\Controllers;

use App\Models\DuDi;
use App\Models\Kerjasama;
use App\Models\PenanggungJawab;
use App\Models\Prodi;
use Illuminate\Http\Request;
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
                $edit = '<a href="#" class="btn text-white btn-info btn-sm mt-1 editDuDi">MOU</a>';
                $delete = '<a href="#" class="btn text-white btn-danger btn-sm mt-1 deleteDuDi">PKS</a>';

                return $edit . ' ' . $delete;
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
        $data = DuDi::select('dudi.nama', 'dudi.lingkup_kerjasama', 'dudi.kategori_mitra', 'indonesia_provinces.name as provinsi', 'indonesia_cities.name as kota')->join('indonesia_provinces', 'dudi.provinsi', '=', 'indonesia_provinces.id')->join('indonesia_cities', 'dudi.kota', '=', 'indonesia_cities.id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dudiId = $request->dudiId;
        if (!$dudiId) {
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
            $dudiId = $dudi->id;
        }


        $penanggungJawab = PenanggungJawab::create([
            'nama' => $request->nama_penanggungJawab,
            'dudi_id' => $dudiId,
            'kewarganegaraan' => $request->kewarganegaraan,
            'no_telp' => $request->no_telp_penanggung,
        ]);

        $kerjasama = Kerjasama::create([
            'prodi' => $request->prodi,
            'dudi_id' => $dudiId,
            'bidang_kerjasama' => $request->bidang,
            'nama_pks' => $request->nama_pks,
            'no_pks' => $request->no_pks,
            'mulai_pks' => $request->mulai_pks,
            'penetapan_pks' => $request->penetapan_pks,
            'selesai_pks' => $request->selesai_pks,
            'dokumen_pks' => $request->dokumen_pks,
            'dokumen_mou' => $request->dokumen_mou
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $kerjasama
        ]);
    }

    public function edit($id)
    {
        $data = DuDi::find($id);
        return response()->json($data);
    }
    // public function update(Request $request, DuDi $dudi)
    // {

    //     $dudi->nib = $request->nib;
    //     $dudi->nama = $request->nama;
    //     $dudi->kriteria_mitra = $request->kriteria_mitra;
    //     $dudi->lingkup_kerjasama = $request->email;
    //     $dudi->no_telp = $request->no_telp;
    //     $dudi->sk_pendirian = $request->sk_pendirian;
    //     $dudi->kbli = $request->kbli;
    //     $dudi->alamat = $request->alamat;
    //     $dudi->provinsi = $request->input('provinsi');
    //     $dudi->kabupaten_kota = $request->input('kabupaten_kota');
    //     $dudi->kecamatan = $request->input('kecamatan');
    //     $dudi->kelurahan = $request->input('kelurahan');

    //     $dudi->save();

    //     return redirect()->route('dudi.index');
    // }
}
