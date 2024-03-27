<!-- Modal DUDI -->
<div class="modal fade" id="modalDudiNIB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Dudi NIB</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDudi" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="dudiId" id="dudiId">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="nib" class="form-label">NIB</label>
                            <input type="text" class="form-control" id="nib" name="nib"
                                aria-describedby="nib" required>
                            <span class="text-danger error-nib"></span>

                        </div>
                        <div class="col-md-8">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                aria-describedby="nama" required>
                            <span class="text-danger error-nama"></span>

                        </div>
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori Mitra</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih</option>
                                <option value="BUMN">BUMN</option>
                                <option value="Lembaga Sertifikasi">Lembaga Sertifikasi</option>
                                <option value="Perusahaan Swasta">Perusahaan Swasta</option>
                                <option value="Instansi Pemerintah">Instansi Pemerintah</option>
                                <option value="Sekolah Negeri">Sekolah Negeri</option>
                                <option value="Sekolah Swasta">Sekolah Swasta</option>
                                <option value="PTN">PTN</option>
                                <option value="PTS">PTS</option>
                            </select>
                            <span class="text-danger error-kategori"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="lingkup" class="form-label">Lingkup Kerjasama</label>
                            <select name="lingkup" id="lingkup" class="form-control">
                                <option value="">Pilih</option>
                                <option value="nasional">Nasional</option>
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
                                    <option value="{{ $item->name ?? '' }}">{{ $item->name ?? '' }}</option>
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

                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                    <button type="submit" class="btn btn-warning" id="update">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data DUDI NIB</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Download Template dulu dan isikan data sesuai format dari template
                            setelah itu siap di upload</label>
                    </div>
                    <div class="col-md-12">
                        <a href="{{asset('template_excel/Template_dudi_Nib.xlsx')}}">Download Template</a>
                    </div>
                    <div class="col-md-12">
                        <label for="nama" class="form-label">Upload</label>
                        <form method="post" action="{{ route('dudiNib.import') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="file" class="form-control" name="file" id="file"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                <button class="btn btn-outline-secondary" type="submit"
                                    id="inputGroupFileAddon04">Import</button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
