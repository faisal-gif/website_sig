@extends('layouts.layouts-admin')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Data Program Studi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Program Studi</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <button type="button" id="tambah_prodi" class="btn btn-sm btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-fa fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
@include('manage.prodi.modal')
@section('script')
<script>
    const prodiIndex = "{{ route('prodi.index') }}";
    const prodiStore = "{{ route('prodi.store') }}";
    const prodiEdit = '{{ route('prodi.edit', ['id' => 'prodi_id']) }}';
    const prodiUpdate = '{{ route('prodi.update', ['id' => 'prodi_id']) }}';
    const prodiDelete = '{{ route('prodi.destroy', ['id' => 'prodi_id']) }}';

    $(function () {


        var table = $('#dataTable').DataTable({
            processing: false,
            serverSide: false,
            responsive: true,
            ajax: prodiIndex,
            columns: [{
                data: 'kode',
                name: 'kode',
            },
            {
                data: 'nama',
                name: 'nama',
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

        $('#tambah_prodi').click(function () {
            $('#simpan').show();
            $('#update').hide();
            $('#idProdi').val('');
            $('#formProdi').trigger('reset');
            $('#modalProdi').modal('show');
        });

        $('#simpan').click(function (e) {
            e.preventDefault();

            var formData = new FormData($("#formProdi")[0]);

            var url = prodiStore;
            var method = "POST";

            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: url,
                type: "POST",
                success: function (data) {
                    $('#formProdi').trigger("reset");
                    $('#modalProdi').modal('hide');
                    table.ajax.reload();

                    Swal.fire({
                        title: "Berhasil!",
                        text: "Data Berhasil Disimpan.",
                        icon: "success",
                        timer: 3000
                    });
                },
                error: function (data) {
                    console.error('Error:', data);
                }
            });
        });

        $('body').on('click', '.editProdi', function () {
            var prodi_id = $(this).data('id');
            $.get(prodiEdit.replace('prodi_id', prodi_id), function (data) {
                $('#simpan').hide();
                $('#update').show();
                $('#idProdi').val(data.id);
                $('#kode').val(data.kode);
                $('#nama').val(data.nama);
                $('#modalProdi').modal('show');
            })
        });

        $('#update').click(function (e) {
            e.preventDefault();

            var prodi_id = $('#idProdi').val();
            var alamat = prodiUpdate.replace('prodi_id', prodi_id);

            var formData = new FormData($("#formProdi")[0]);

            formData.append('_method', 'PUT');

            $.ajax({
                url: alamat,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    table.ajax.reload();
                    $('#formProdi').trigger("reset");
                    $('#modalProdi').modal('hide');
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })


        $('body').on('click', '.deleteProdi', function () {
            var prodi_id = $(this).data('id');
            var alamat = prodiDelete.replace('prodi_id', prodi_id);;

            Swal.fire({
                title: 'Apakah anda ingin menghapus program studi ini ?',
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
                        success: function (response) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        },
                        error: function (data) {
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