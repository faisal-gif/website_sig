<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KerjasamaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_penanggungJawab' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string',
            'no_telp_penanggung' => 'required|min:11',
            'prodi' => 'required|string',
            'bidang' => 'required|string',
            'nama_pks' => 'required|string',
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
            'dudi_id' => $request->idDudi,
            'kewarganegaraan' => $request->kewarganegaraan,
            'no_telp' => $request->no_telp_penanggung,
        ]);

        $dokumenPks = time() . '.' . $request->dokumen_pks->extension();
        $request->dokumen_pks->move(public_path('dokumen_pks'), $dokumenPks);

        $dokumenMou = time() . '.' . $request->dokumen_mou->extension();
        $request->dokumen_mou->move(public_path('dokumen_mou'), $dokumenMou);

        $kerjasama = Kerjasama::create([
            'prodi' => $request->prodi,
            'dudi_id' => $request->idDudi,
            'bidang_kerjasama' => $request->bidang,
            'nama_pks' => $request->nama_pks,
            'no_pks' => $request->no_pks,
            'mulai_pks' => $request->mulai_pks,
            'penetapan_pks' => $request->penetapan_pks,
            'selesai_pks' => $request->selesai_pks,
            'dokumen_pks' => $dokumenPks,
            'dokumen_mou' => $dokumenMou
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $kerjasama
        ]);

    }
}
