<!-- Modal -->
<div class="modal fade" id="modalDudiNonNIB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Dudi Non NIB</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDudi" action="{{ route('kerjasama.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" id="idDudi" required>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama"
                                required="">

                        </div>
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori Mitra</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="mitraBisnis">Mitra Bisnis</option>
                                <option value="mitraStrategis">Mitra Strategis</option>
                                <option value="mitraTeknologi">Mitra Teknologi</option>
                                <option value="mitraRiset">Mitra Riset</option>
                                <option value="mitraPendidikan">Mitra Pendidikan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="lingkup" class="form-label">Lingkup Kerjasama</label>
                           <input type="text" id="lingkup" name="lingkup" class="form-control">

                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email"
                                required="">

                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" aria-describedby="nama"
                                required="">

                        </div>
                        <div class="col-md-6">
                            <label for="sk_pendirian" class="form-label">SK Pendirian</label>
                            <input type="file" class="form-control" id="sk_pendirian" name="sk_pendirian"
                                aria-describedby="sk_pendirian" required="">

                        </div>
                        <div class="col-md-6">
                            <label for="kbli" class="form-label">KBLI</label>
                            <input type="file" class="form-control" id="kbli" name="kbli" aria-describedby="kbli"
                                required="">

                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="alamat"
                                required="">

                        </div>
                        @php
$provinces = new App\Http\Controllers\DependantDropdownController;
$provinces = $provinces->provinces();
                        @endphp
                        <div class="col-md-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($provinces as $item)
                                <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="kota" class="form-label">Kabupaten/Kota</label>
                            <select name="kota" id="kota" class="form-control">
                                <option value="">Pilih</option>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control">
                                <option value="">Pilih</option>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-control">
                                <option value="">Pilih</option>
                            </select>

                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                    <button type="submit" class="btn btn-warning" id="update">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>