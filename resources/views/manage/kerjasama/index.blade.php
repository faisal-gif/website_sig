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
                <button type="button" id="tambah_kerjasama_DuDiNonNIB" class="btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-fa fa-plus"></i>
                    </span>
                    <span class="text">Tambah DUDI Non-NIB</span>
                </button>
                <button type="button" id="tambah_kerjasama_DuDiNIB" class="btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-fa fa-plus"></i>
                    </span>
                    <span class="text">Tambah DUDI NIB</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIB/NPSN/Kode PT</th>
                            <th>Nama</th>
                            <th>Item Kerjasama</th>
                            <th>Status</th>
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
        const KerjasamaIndex = "{{ route('kerjasama.index') }}";
        const KerjasamaStore = "{{ route('kerjasama.store') }}";

        $(function() {

            var table = $('#dataTable').DataTable({
                processing: false,
                serverSide: false,
                responsive: true,
                ajax: KerjasamaIndex,
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
                        data: 'status',
                        name: 'status',
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
            $('#tambah_kerjasama_DuDiNonNIB').click(function() {
                $('#DuDiNonNIB').show();
                $('#DuDiNIB').hide();
                $('#FieldDuDiNonNIB').removeAttr('disabled');
                $('#FieldDuDiNIB').attr('disabled', true);
                $('#formKerjasama').trigger('reset');
                $('#modalKerjasama').modal('show');
            });

            $('#tambah_kerjasama_DuDiNIB').click(function() {
                $('#DuDiNIB').show();
                $('#DuDiNonNIB').hide();
                $('#FieldDuDiNonNIB').attr('disabled', true);
                $('#FieldDuDiNIB').removeAttr('disabled');
                $('#formKerjasama').trigger('reset');
                $('#modalKerjasama').modal('show');
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
