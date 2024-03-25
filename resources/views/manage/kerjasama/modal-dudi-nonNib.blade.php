<!-- Modal Kerjasama -->
<div class="modal fade" id="modalKerjasama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="formKerjasama" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Kerjasama dan Penanggung Jawab</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h2 class="fs-5">DUDI</h2>
                    <div class="row g-3">
                        @php
                            $dudiNonNib = new App\Http\Controllers\DuDiController();
                            $dudiNonNib = $dudiNonNib->getDuDiNonNib();
                        @endphp
                        @php
                            $dudiNib = new App\Http\Controllers\DuDiController();
                            $dudiNib = $dudiNib->getDuDiNib();
                        @endphp
                        <div class="col-md-12" id="DuDiNonNIB">
                            <label for="DuDi" class="form-label">DUDI</label>
                            <select class="form-control selectpicker" data-live-search="true" id="FieldDuDiNonNIB"
                                name="DuDi" aria-describedby="DuDi" title="Pilih Dudi" required>
                                @foreach ($dudiNonNib as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->nama ?? '' }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-DuDi"></span>
                        </div>

                        <div class="col-md-12" id="DuDiNIB">
                            <label for="DuDi" class="form-label">DUDI</label>
                            <select class="form-control selectpicker" data-live-search="true" id="FieldDuDiNIB"
                                name="DuDi" aria-describedby="DuDi" title="Pilih Dudi" required>
                                @foreach ($dudiNib as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->nib ?? '' }} | {{ $item->nama ?? '' }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-DuDi"></span>
                        </div>
                    </div>
                    <h2 class="fs-5 mt-3">Penanggung Jawab</h2>
                    <div class="row g-3">
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
                            <input type="text" class="form-control" id="no_telp_penanggung" name="no_telp_penanggung"
                                aria-describedby="no_telp_penanggung" required>
                            <span class="text-danger error-no_telp_penanggung"></span>
                        </div>
                    </div>

                    <h2 class="fs-5 mt-3">Kerjasama</h2>
                    <div class="row g-3">
                        @php
                            $prodi = new App\Http\Controllers\ProdiController();
                            $prodi = $prodi->getProdi();
                        @endphp
                        <div class="col-md-6">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select name="prodi" id="prodi" class="form-control selectpicker"
                                data-live-search="true" title="Pilih Program Studi">
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id ?? '' }}">{{ $item->nama ?? '' }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-prodi"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="bidang" class="form-label">Bidang Kerjasama</label>
                            <select name="bidang" id="bidang" class="form-control selectpicker"
                                data-live-search="true" title="Pilih Bidang Kerjasama">
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
