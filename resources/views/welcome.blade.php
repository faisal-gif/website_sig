@extends('layouts.layouts-admin')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Data Kerjasama</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kerjasama</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIB/NPSN/Kode PT</th>
                        <th>Nama</th>
                        <th>Item Kerjasama</th>
                        <th>MOU dan PKS</th>
                 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection