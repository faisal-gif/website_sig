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
                <button type="button" id="tambah_dudi_non_nib" class="btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-fa fa-plus"></i>
                    </span>
                    <span class="text">Tambah DUDI</span>
                </button>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-fa fa-plus"></i>
                    </span>
                    <span class="text">Impor Excel</span>
                </button>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('manage.dudi_non_nib.modal')
@section('script')
    <script>
        const DudiNonNibIndex = "{{ route('dudiNonNib.index') }}";
        const DuDiStore = "{{ route('dudiNonNib.store') }}";
        const DuDiEdit = "{{ route('dudiNonNib.edit', ['id' => 'id']) }}";
        const DuDiUpdate = "{{ route('dudiNonNib.update', ['id' => 'id']) }}";
        const DuDiDelete = "{{ route('dudiNonNib.destroy', ['id' => 'id']) }}";

        function onChangeSelect(url, val, name, defaultValue = null) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    val: val
                },
                success: function(data) {

                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + value + '">' + value + '</option>');
                    });

                    if (defaultValue !== null) {
                        $('#' + name).val(defaultValue).trigger('change');
                    }
                }
            });
        }

        $(function() {

            $('#provinsi').on('change', function() {
                $('#kota').empty().append('<option value="">Pilih</option>');
                $('#kecamatan').empty().append('<option value="">Pilih</option>');
                $('#kelurahan').empty().append('<option value="">Pilih</option>');

                onChangeSelect('{{ route('cities') }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function() {
                $('#kecamatan').empty().append('<option value="">Pilih</option>');
                $('#kelurahan').empty().append('<option value="">Pilih</option>');

                onChangeSelect('{{ route('districts') }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function() {
                $('#kelurahan').empty().append('<option value="">Pilih</option>');

                onChangeSelect('{{ route('villages') }}', $(this).val(), 'kelurahan');
            })

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
                $('#update').hide();
                $('#modalDudiNonNIB').modal('show');
            });

            $('#simpan').click(function(e) {
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

            $('body').on('click', '.editDudi', function() {
                var dudi_id = $(this).data('id');
                $.get(DuDiEdit.replace('id', dudi_id), function(data) {
                    $('#simpan').hide();
                    $('#update').show();
                    $('#update').val("edit-dudi");
                    $('#modalDudiNonNIB').modal('show');
                    $('#dudiId').val(data.id);
                    $('#nama').val(data.nama);
                    $('#kategori').val(data.kategori_mitra);
                    $('#lingkup').val(data.lingkup_kerjasama);
                    $('#email').val(data.email);
                    $('#no_telepon').val(data.no_telp);
                    $('#sk_pendirian').val(data.sk_pendirian);
                    $('#kbli').val(data.kbli);
                    $('#alamat').val(data.alamat);
                    $('#provinsi').val(data.provinsi);

                    onChangeSelect('{{ route('cities') }}', data.provinsi, 'kota', data.kota);
                    onChangeSelect('{{ route('districts') }}', data.kota, 'kecamatan', data
                        .kecamatan);
                    onChangeSelect('{{ route('villages') }}', data.kecamatan, 'kelurahan', data
                        .kelurahan);

                });
            });

            $('#update').click(function(e) {
                e.preventDefault();

                var id = $('#dudiId').val();
                var alamat = DuDiUpdate.replace('id', id);

                var formData = new FormData($("#formDudi")[0]);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: alamat,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#formDudi').trigger("reset");
                            $('#modalDudiNonNIB').modal('hide');
                            table.ajax.reload();
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                $('.error-' + key).text(value);
                            });
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '.deleteDuDiNonNib', function() {
                var id = $(this).data('id');
                var alamat = DuDiDelete.replace('id', id);;

                Swal.fire({
                    title: 'Apakah anda ingin menghapus DUDI ini ?',
                    text: 'Data yang Dihapus Tidak Dapat Dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: alamat,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: `${response.message}`,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                alert('Produk Gagal Di Hapus!');
                            }
                        });

                    }
                });
            });
        })
    </script>
@endsection
@endsection
