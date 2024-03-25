<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KerjasamaController extends Controller
{
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
            ->addColumn('status', function ($row) {
                $stat = "";
                if ($row === 'berjalan') {
                    $stat = '<a href="javascript:void(0)" class="text-white btn-info btn-sm mt-1">Berjalan</a>';
                } else {
                    $stat = '<a href="javascript:void(0)" class="text-white btn-danger btn-sm mt-1">Selesai</a>';
                }
                return $stat;
            })
            ->rawColumns(['action', 'item_kerjasama', 'nib','status'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_penanggungJawab' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string',
            'no_telp_penanggung' => 'required|min:11',
            'prodi' => 'required|string',
            'bidang' => 'required|string',
            'nama_pks' => 'required|string',
            'DuDi' => 'required|string',
            'no_pks' => 'required|string',
            'mulai_pks' => 'required|date',
            'penetapan_pks' => 'required|date',
            'selesai_pks' => 'required|date',
            'dokumen_pks' => 'required',
            'dokumen_mou' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $penanggungJawab = PenanggungJawab::create([
            'nama' => $request->nama_penanggungJawab,
            'dudi_id' => $request->DuDi,
            'kewarganegaraan' => $request->kewarganegaraan,
            'no_telp' => $request->no_telp_penanggung,
        ]);

        $dokumenPks = time() . '.' . $request->dokumen_pks->extension();
        $request->dokumen_pks->move(public_path('dokumen_pks'), $dokumenPks);

        $dokumenMou = time() . '.' . $request->dokumen_mou->extension();
        $request->dokumen_mou->move(public_path('dokumen_mou'), $dokumenMou);

        $status = "";
        if ($request->selesai_pks < now()) {
            $status = "selesai";
        } else {
            $status = "berjalan";
        }

        $kerjasama = Kerjasama::create([
            'prodi' => $request->prodi,
            'dudi_id' => $request->DuDi,
            'bidang_kerjasama' => $request->bidang,
            'nama_pks' => $request->nama_pks,
            'no_pks' => $request->no_pks,
            'mulai_pks' => $request->mulai_pks,
            'penetapan_pks' => $request->penetapan_pks,
            'selesai_pks' => $request->selesai_pks,
            'dokumen_pks' => $dokumenPks,
            'dokumen_mou' => $dokumenMou,
            'status' => $status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $kerjasama
        ]);

    }
}
