<?php

namespace App\Imports;

use App\Models\DuDi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DuDiNonNibImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new DuDi([
            'nama' => $row['namadudi'],
            'jenis' => "non_nib",
            'kategori_mitra' => $row['kategorimitra'],
            'lingkup_kerjasama' => $row['lingkupkerjasama'],
            'email' => $row['email'],
            'no_telp' => $row['notelepon'],
            'sk_pendirian' => $row['skpendirian'],
            'kbli' => $row['kbli'],
            'alamat' => $row['alamat'],
            'provinsi' => $row['provinsi'],
            'kota' => $row['kota'],
            'kecamatan' => $row['kecamatan'],
            'kelurahan' => $row['kelurahan'],
        ]);
    }
}
