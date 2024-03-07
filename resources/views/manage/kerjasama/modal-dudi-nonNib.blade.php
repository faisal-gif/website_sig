<form id="formDudi" enctype="multipart/form-data">
    @csrf
    <!-- Modal DUDI -->
    <div class="modal fade" id="modalDudiNonNIB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Dudi Non NIB</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <input type="hidden" name="id" id="idDudi" required>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                aria-describedby="nama" required="">

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
                            <select name="lingkup" id="lingkup" class="form-control">
                                <option value="nasionl">Nasional</option>
                                <option value="intenational">International</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="email" required="">

                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                aria-describedby="nama" required="">

                        </div>
                        <div class="col-md-6">
                            <label for="sk_pendirian" class="form-label">SK Pendirian</label>
                            <input type="file" class="form-control" id="sk_pendirian" name="sk_pendirian"
                                aria-describedby="sk_pendirian" required="">

                        </div>
                        <div class="col-md-6">
                            <label for="kbli" class="form-label">KBLI</label>
                            <input type="file" class="form-control" id="kbli" name="kbli"
                                aria-describedby="kbli" required="">

                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                aria-describedby="alamat" required="">

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

                    <button class="btn btn-primary" data-bs-target="#kerjasama" data-bs-toggle="modal">Next</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>


            </div>
        </div>
    </div>
    <!-- Modal Kerjasama -->
    <div class="modal fade" id="kerjasama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Kerjasama dan Penanggung Jawab</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="h3 mb-2 text-gray-800">Penanggung Jawab</h2>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="nama_penanggungJawab" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_penanggungJawab"
                                name="nama_penanggungJawab" aria-describedby="nama_penanggungJawab" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan"
                                aria-describedby="no_pks" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="no_telp_penanggung" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_telp_penanggung"
                                name="no_telp_penanggung" aria-describedby="no_telp_penanggung" required="">
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
                        </div>
                        <div class="col-md-6">
                            <label for="bidang" class="form-label">Bidang Kerjasama</label>
                            <select name="bidang" id="bidang" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Riset dan Pengembangan">Riset dan Pengembangan</option>
                                <option value="Pengelolaan Proyek">Pengelolaan Proyek</option>
                                <option value="Pelatihan dan Pengembangan">Pelatihan dan Pengembangan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="nama_pks" class="form-label">Nama PKS</label>
                            <input type="text" class="form-control" id="nama_pks" name="nama_pks"
                                aria-describedby="nama_pks" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="no_pks" class="form-label">No. PKS</label>
                            <input type="text" class="form-control" id="no_pks" name="no_pks"
                                aria-describedby="no_pks" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="mulai_pks" class="form-label">Mulai PKS</label>
                            <input type="date" class="form-control" id="mulai_pks" name="mulai_pks"
                                aria-describedby="mulai_pks" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="selesai_pks" class="form-label">Selesai PKS</label>
                            <input type="date" class="form-control" id="selesai_pks" name="selesai_pks"
                                aria-describedby="selesai_pks" required="">
                        </div>
                        <div class="col-md-4">
                            <label for="penetapan_pks" class="form-label">Penetapan PKS</label>
                            <input type="date" class="form-control" id="penetapan_pks" name="penetapan_pks"
                                aria-describedby="penetapan_pks" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="dokumen_pks" class="form-label">Dokumen PKS</label>
                            <input type="file" class="form-control" id="dokumen_pks" name="dokumen_pks"
                                aria-describedby="dokumen_pks" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="dokumen_mou" class="form-label">Dokumen MOU</label>
                            <input type="file" class="form-control" id="dokumen_mou" name="dokumen_mou"
                                aria-describedby="dokumen_mou" required="">
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-target="#modalDudiNonNIB"
                        data-bs-toggle="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
