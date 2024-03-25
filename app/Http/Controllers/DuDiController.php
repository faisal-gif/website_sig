<?php

namespace App\Http\Controllers;

use App\Imports\DuDiNibImport;
use App\Imports\DuDiNonNibImport;
use App\Models\DuDi;
use App\Models\Kerjasama;
use App\Models\PenanggungJawab;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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
    public function getDuDiNonNib()
    {
        return DuDi::where('jenis', 'non_nib')->get();
    }
    public function getDuDiNib()
    {
        return DuDi::where('jenis', 'nib')->get();
    }

    // DUDI NON NIB
    public function dudiNonNib()
    {
        return view('manage.dudi_non_nib.index');
    }
    public function dudiNonNibindex()
    {
        $data = DuDi::where('jenis', 'non_nib')->select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit = '<a href="javascript:void(0)" id="editDudi" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editDudi"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteDuDiNonNib"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function storeDudDiNonNib(Request $request)
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
            'jenis' => "non_nib",
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

    public function editDudDiNonNib($id)
    {
        $data = DuDi::find($id);
        return response()->json($data);
    }

    public function updateDudDiNonNib(Request $request)
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

        $id = $request->dudiId;
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

    public function destroyDudDiNonNib($id)
    {
        $dudi = DuDi::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

    public function importDudDiNonNib(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new DuDiNonNibImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diimport',
        ]);
    }


    // DUDI NIB
    public function dudiNib()
    {
        return view('manage.dudi_nib.index');
    }
    public function dudiNibindex()
    {
        $data = DuDi::where('jenis', 'nib')->select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit = '<a href="javascript:void(0)" id="editDudi" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editDudi"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteDuDiNib"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function storeDudDiNib(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nib' => 'required|string|max:255',
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
            'nib' => $request->nib,
            'jenis' => "nib",
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

    public function editDudDiNib($id)
    {
        $data = DuDi::find($id);
        return response()->json($data);
    }

    public function updateDudDiNib(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nib' => 'required|string|max:255',
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

        $id = $request->dudiId;
        $dudi = DuDi::findOrFail($id);

        $dudi->nama = $request->nama;
        $dudi->nib = $request->nib;
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

    public function destroyDudDiNib($id)
    {
        $dudi = DuDi::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

    public function importDudDiNib(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new DuDiNibImport, $file);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diimport',
        ]);
    }

}





