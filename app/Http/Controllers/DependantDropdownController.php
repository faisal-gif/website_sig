<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;


class DependantDropdownController extends Controller
{
    public function provinces()
    {
        return Provinsi::all();
    }

    public function cities(Request $request)
    {
        $provinsi = Provinsi::where('name', $request->val)->first()->code;
        return Kota::where('province_code', $provinsi)->pluck('name', 'id');
    }

    public function districts(Request $request)
    {
        $kota = Kota::where('name', $request->val)->first()->code;
        return Kecamatan::where('city_code', $kota)->pluck('name', 'id');
    }

    public function villages(Request $request)
    {
        $kecamatan = Kecamatan::where('name', $request->val)->first()->code;
        return Kelurahan::where('district_code', $kecamatan)->pluck('name', 'id');
    }
}
