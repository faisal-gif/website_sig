<!-- Modal DUDI -->
<div class="modal fade" id="modalDudiNonNIB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Dudi Non NIB</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDudi" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                aria-describedby="nama" required>
                            <span class="text-danger error-nama"></span>

                        </div>
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori Mitra</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih</option>
                                <option value="mitraBisnis">Mitra Bisnis</option>
                                <option value="mitraStrategis">Mitra Strategis</option>
                                <option value="mitraTeknologi">Mitra Teknologi</option>
                                <option value="mitraRiset">Mitra Riset</option>
                                <option value="mitraPendidikan">Mitra Pendidikan</option>
                            </select>
                            <span class="text-danger error-kategori"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="lingkup" class="form-label">Lingkup Kerjasama</label>
                            <select name="lingkup" id="lingkup" class="form-control">
                                <option value="">Pilih</option>
                                <option value="nasionl">Nasional</option>
                                <option value="intenational">International</option>
                            </select>
                            <span class="text-danger error-lingkup"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="email" required="">
                            <span class="text-danger error-email"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="no_telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                aria-describedby="nama" required>
                            <span class="text-danger error-no_telepon"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="sk_pendirian" class="form-label">SK Pendirian</label>
                            <input type="text" class="form-control" id="sk_pendirian" name="sk_pendirian"
                                aria-describedby="sk_pendirian" required>
                            <span class="text-danger error-sk_pendirian"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="kbli" class="form-label">KBLI</label>
                            <input type="text" class="form-control" id="kbli" name="kbli"
                                aria-describedby="kbli" required>
                            <span class="text-danger error-kbli"></span>
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                aria-describedby="alamat" required>
                            <span class="text-danger error-alamat"></span>
                        </div>
                        @php
                            $provinces = new App\Http\Controllers\DependantDropdownController();
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
                            <span class="text-danger error-provinsi"></span>
                        </div>
                        <div class="col-md-3">
                            <label for="kota" class="form-label">Kabupaten/Kota</label>
                            <select name="kota" id="kota" class="form-control">

                            </select>
                            <span class="text-danger error-kota"></span>
                        </div>
                        <div class="col-md-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control">

                            </select>
                            <span class="text-danger error-kecamatan"></span>
                        </div>
                        <div class="col-md-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-control">
                            </select>
                            <span class="text-danger error-kelurahan"></span>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="simpanDudiNonNib">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Kerjasama -->
<div class="modal fade" id="modalKerjasama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="formKerjasama" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Kerjasama dan Penanggung Jawab</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h2 class="h3 mb-2 text-gray-800">Penanggung Jawab</h2>
                    <div class="row g-3">

                        <input type="hidden" name="idDudi" id="idDudi">
                        <div class="col-md-4">
                            <label for="nama_penanggungJawab" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_penanggungJawab"
                                name="nama_penanggungJawab" aria-describedby="nama_penanggungJawab" required>
                            <span class="text-danger error-nama_penanggungJawab"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan"
                                aria-describedby="no_pks" required="">
                            <span class="text-danger error-kewarganegaraan"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="no_telp_penanggung" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_telp_penanggung"
                                name="no_telp_penanggung" aria-describedby="no_telp_penanggung" required>
                            <span class="text-danger error-no_telp_penanggung"></span>
                        </div>
                    </div>

                    <h2 class="h3 mb-2 mt-4 text-gray-800">Kerjasama</h2>
                    <div class="row g-3">
                        @php
                            $prodi = new App\Http\Controllers\ProdiController();
                            $prodi = $prodi->getProdi();
                        @endphp
                        <div class="col-md-6">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select name="prodi" id="prodi" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->nama ?? '' }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-prodi"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="bidang" class="form-label">Bidang Kerjasama</label>
                            <select name="bidang" id="bidang" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Riset dan Pengembangan">Riset dan Pengembangan</option>
                                <option value="Pengelolaan Proyek">Pengelolaan Proyek</option>
                                <option value="Pelatihan dan Pengembangan">Pelatihan dan Pengembangan</option>
                            </select>
                            <span class="text-danger error-bidang"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="nama_pks" class="form-label">Nama PKS</label>
                            <input type="text" class="form-control" id="nama_pks" name="nama_pks"
                                aria-describedby="nama_pks" required>
                            <span class="text-danger error-nama_pks"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="no_pks" class="form-label">No. PKS</label>
                            <input type="text" class="form-control" id="no_pks" name="no_pks"
                                aria-describedby="no_pks" required="">
                            <span class="text-danger error-no_pks"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="mulai_pks" class="form-label">Mulai PKS</label>
                            <input type="date" class="form-control" id="mulai_pks" name="mulai_pks"
                                aria-describedby="mulai_pks" required>
                            <span class="text-danger error-mulai_pks"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="selesai_pks" class="form-label">Selesai PKS</label>
                            <input type="date" class="form-control" id="selesai_pks" name="selesai_pks"
                                aria-describedby="selesai_pks" required>
                            <span class="text-danger error-penetapan_pks"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="penetapan_pks" class="form-label">Penetapan PKS</label>
                            <input type="date" class="form-control" id="penetapan_pks" name="penetapan_pks"
                                aria-describedby="penetapan_pks" required>
                            <span class="text-danger error-selesai_pks"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="dokumen_pks" class="form-label">Dokumen PKS</label>
                            <input type="file" class="form-control" id="dokumen_pks" name="dokumen_pks"
                                aria-describedby="dokumen_pks" required>
                            <span class="text-danger error-dokumen_pks"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="dokumen_mou" class="form-label">Dokumen MOU</label>
                            <input type="file" class="form-control" id="dokumen_mou" name="dokumen_mou"
                                aria-describedby="dokumen_mou" required>
                            <span class="text-danger error-dokumen_mou"></span>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="simpanKerjasama">Simpan</button>
                </div>

            </div>
        </form>
    </div>
</div>
