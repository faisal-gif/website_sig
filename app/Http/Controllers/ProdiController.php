<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProdi()
    {
        return Prodi::all();
    }

    public function show()
    {
        return view('manage.prodi.index');
    }

    public function index()
    {

        $prodi = Prodi::all();
        return DataTables::of($prodi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit = '<a href="javascript:void(0)" id="edit_prodi" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editProdi"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteProdi"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }



    private function validateRequest(Request $request)
    {
        $rules = [
            'kode' => 'required|',
            'nama' => 'required|',
        ];

        $request->validate($rules);
    }

    public function store(Request $request)
    {

        $this->validateRequest($request);

        $prodi = Prodi::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $prodi
        ]);
    }
    public function edit($id)
    {
        $prodi = Prodi::find($id);
        return response()->json($prodi);
    }
    public function update(Request $request)
    {
        $this->validateRequest($request);

        $id = $request->id;
        $prodi = Prodi::findOrFail($id);

        $prodi->kode = $request->kode;
        $prodi->nama = $request->nama;
        $prodi->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah',
        ]);
    }

    public function destroy($id)
    {
        $prodi = Prodi::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }
}
