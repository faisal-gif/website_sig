@extends('layouts.layouts-admin')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Data Dudi Integrasi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dudi Integrasi</h6>
    </div>
    <div class="card-body">
    <div class="mb-3">
            <a href="" class="btn btn-sm btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-fa fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th>NIB/NPSN</th>
                        <th>Tipe</th>
                        <th>Nama Perseroan</th>
                        <th>Provinsi</th>
                        <th>Kabupaten/Kota</th>
                        <th>Lingkup</th>
                        <th>Kategori Mitra</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>61</td>
                        <td>2011/04/25</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection