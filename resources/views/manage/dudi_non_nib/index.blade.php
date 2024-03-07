@extends('layouts.layouts-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Data Dudi Non Integrasi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dudi Non Integrasi</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                {{-- <a href="" class="btn btn-sm btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-fa fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Perseroan</th>
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Lingkup</th>
                            <th>Kategori Mitra</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('script')
    <script>
        const  DudiNonNibIndex = "{{ route('dudiNonNib.index') }}";

        $(function() {


            var table = $('#dataTable').DataTable({
                processing: false,
                serverSide: false,
                responsive: true,
                ajax: DudiNonNibIndex,
                columns: [{
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'provinsi',
                        name: 'provinsi',
                    },
                    {
                        data: 'kota',
                        name: 'kota',
                    },
                    {
                        data: 'lingkup_kerjasama',
                        name: 'lingkup_kerjasama',
                    },
                    {
                        data: 'kategori_mitra',
                        name: 'kategori_mitra',
                    },
                ],
                search: {
                    "regex": true
                }
            });

           

        })
    </script>
@endsection
@endsection
