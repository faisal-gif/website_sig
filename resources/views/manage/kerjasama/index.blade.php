@extends('layouts.layouts-admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Data Kerjasama</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kerjasama</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" id="tambah_dudi_non_nib" class="btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-fa fa-plus"></i>
                    </span>
                    <span class="text">Tambah DUDI Non-NIB</span>
                </button>
            </div>
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
                </table>
            </div>
        </div>
    </div>

    @include('manage.kerjasama.modal-dudi-nonNib')
@section('script')
    <script>
        const DuDiIndex = "{{ route('kerjasama.index') }}";
        const DuDiStore = "{{ route('dudiNonNib.store') }}";
        const KerjasamaStore = "{{ route('kerjasama.store') }}";

        function onChangeSelect(url, id, name) {

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Pilih</option>');

                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

        $(function() {
            $('#provinsi').on('change', function() {
                onChangeSelect('{{ route('cities') }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function() {
                onChangeSelect('{{ route('districts') }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function() {
                onChangeSelect('{{ route('villages') }}', $(this).val(), 'kelurahan');
            })

            var table = $('#dataTable').DataTable({
                processing: false,
                serverSide: false,
                responsive: true,
                ajax: DuDiIndex,
                columns: [{
                        data: 'nib',
                        name: 'nib',
                    },
                    {
                        data: 'nama_dudi',
                        name: 'nama_dudi',
                    },
                    {
                        data: 'item_kerjasama',
                        name: 'item_kerjasama',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
                search: {
                    "regex": true
                }
            });
            $('#tambah_dudi_non_nib').click(function() {
                $('#idDudi').val('');
                $('#formDudi').trigger('reset');
                $('#modalDudiNonNIB').modal('show');
            });
            $('#simpanDudiNonNib').click(function(e) {
                e.preventDefault();

                var formData = new FormData($("#formDudi")[0]);

                var url = DuDiStore;
                var method = "POST";

                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: url,
                    type: "POST",
                    success: function(data) {
                        if (data.success) {
                            $('#formDudi').trigger("reset");
                            $('#modalDudiNonNIB').modal('hide');
                            $('#idDudi').val(data.data);
                            $('#modalKerjasama').modal('show');
                        } else {
                            $.each(data.errors, function(key, value) {
                                $('.error-' + key).text(value);
                            });
                        }
                    },
                    error: function(data) {
                        console.error('Error:', data);
                    }
                });
            });

            $('#simpanKerjasama').click(function(e) {
                e.preventDefault();

                var formData = new FormData($("#formKerjasama")[0]);

                var method = "POST";

                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: KerjasamaStore,
                    type: "POST",
                    success: function(data) {
                        if (data.success) {
                            $('#formKerjasama').trigger("reset");
                            $('#modalKerjasama').modal('hide');
                            table.ajax.reload();

                            Swal.fire({
                                title: "Berhasil!",
                                text: "Data Berhasil Disimpan.",
                                icon: "success",
                                timer: 3000
                            });
                        } else {
                            $.each(data.errors, function(key, value) {
                                $('.error-' + key).text(value);
                            });
                        }
                    },
                    error: function(data) {
                        console.error('Error:', data);
                    }
                });
            });

        })
    </script>
@endsection
@endsection
