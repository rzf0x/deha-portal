<div>

    <div class="d-flex mb-2">
        <a href="{{ route('admin.master-santri.santri') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle-fill"></i>
            Kembali ke list santri
        </a>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-4 text-center">
                    @if ($santri->foto)
                        <img style="object-fit: cover"
                            src="{{ Storage::url('images/santri/' . basename($santri->foto)) }}"
                            class="img-fluid w-75 rounded-2 h-75 mx-auto" alt="">
                    @else
                        <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}"
                            class="img-fluid rounded-3 w-75 mx-auto" alt="">
                    @endif

                    <div class="mt-2">
                        {{-- Status Kesantrian --}}
                        <p>
                            Status kesantrian :
                            <span
                                class="badge {{ $santri->status_kesantrian == 'aktif' ? 'bg-primary' : 'bg-secondary' }}">
                                {{ $santri->status_kesantrian }}
                            </span>
                        </p>
                    </div>
                    <div class="form-paginate d-flex">
                        <button {{ $formPage == 1 ? 'disabled' : '' }} type="button" wire:click='prevForm'
                            class="prev-form btn">Sebelumnya</button>
                        <button {{ $formPage == 2 ? 'disabled' : '' }} type="button" wire:click='nextForm'
                            class="next-form btn text-primary">Selanjutnya</button>
                    </div>
                </div>
                <div class="col-lg-8 row mb-2">
                    @if ($formPage == 1)
                        <div class="col-lg-4 mb-2">
                            <x-more-components.form-input-basic label="Nama Santri" name="nama_santri"
                                value="{{ $santri->nama }}" readonly="true" />

                            <!-- Kewarganegaraan Santri -->
                            <x-more-components.form-input-basic label="Kewarganegaraan Santri" name="kewarganegaraan"
                                value="{{ $santri->kewarganegaraan }}" readonly="true" />

                            <!-- NIK Santri -->
                            <x-more-components.form-input-basic label="NIK Santri" name="nik"
                                value="{{ $santri->nik }}" readonly="true" />

                            <!-- Agama Santri -->
                            <x-more-components.form-input-basic label="Agama Santri" name="agama"
                                value="{{ $santri->agama }}" readonly="true" />

                            <!-- Hobi Santri -->
                            <x-more-components.form-input-basic label="Hobi Santri" name="hobi"
                                value="{{ $santri->hobi }}" readonly="true" />

                            <!-- Aktivitas Pendidikan Santri -->
                            <x-more-components.form-input-basic label="Aktivitas Pendidikan Santri"
                                name="aktivitas_pendidikan" value="{{ $santri->aktivitas_pendidikan }}"
                                readonly="true" />

                            <!-- Kamar Santri -->
                            <div class="form-group">
                                <label>Kamar</label> <br>
                                <p class="badge bg-info">
                                    {{ $santri->kamar->nama }}
                                </p>
                            </div>

                        </div>

                        <div class="col-lg-4 mb-2">
                            <!-- NISN Santri -->
                            <x-more-components.form-input-basic label="NISN Santri" name="nisn"
                                value="{{ $santri->nisn }}" readonly="true" />

                            <!-- Tempat & Tanggal Lahir Santri -->
                            <x-more-components.form-input-basic label="Tempat & Tanggal Lahir Santri"
                                name="tempat_tanggal_lahir"
                                value="{{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir }}" readonly="true" />

                            <!-- Jenis Kelamin Santri -->
                            <x-more-components.form-input-basic label="Jenis Kelamin Santri" name="jenis_kelamin"
                                value="{{ $santri->jenis_kelamin == 'putera' ? 'laki-laki' : 'perempuan' }}"
                                readonly="true" />

                            <!-- No KIP Santri -->
                            <x-more-components.form-input-basic label="No KIP Santri" name="no_kip"
                                value="{{ $santri->no_kip }}" readonly="true" />

                            <!-- No KK Santri -->
                            <x-more-components.form-input-basic label="No KK Santri" name="no_kk"
                                value="{{ $santri->no_kk }}" readonly="true" />

                            <!-- Nama Kepala Keluarga Santri -->
                            <x-more-components.form-input-basic label="Nama Kepala Keluarga Santri"
                                name="nama_kepala_keluarga" value="{{ $santri->nama_kepala_keluarga }}"
                                readonly="true" />

                            <!-- Kelas Santri -->
                            <div class="form-group">
                                <label>Kelas</label> <br>
                                <p class="badge bg-success">
                                    {{ $santri->kelas->nama }}
                                </p>
                            </div>

                        </div>

                        <div class="col-lg-4 mb-2">
                            <!-- NISM Santri -->
                            <x-more-components.form-input-basic label="NISM Santri" name="nism"
                                value="{{ $santri->nism }}" readonly="true" />

                            <!-- Jumlah Saudara Kandung -->
                            <x-more-components.form-input-basic label="Jumlah Saudara Kandung"
                                name="jumlah_saudara_kandung" value="{{ $santri->jumlah_saudara_kandung }} Saudara"
                                readonly="true" />

                            <!-- Anak Ke- -->
                            <x-more-components.form-input-basic label="Anak Ke-" name="anak_ke"
                                value="{{ $santri->anak_ke }}" readonly="true" />

                            <!-- NPSN Santri -->
                            <x-more-components.form-input-basic label="NPSN Santri" name="npsn"
                                value="{{ $santri->npsn }}" readonly="true" />

                            <!-- Riwayat Penyakit Santri -->
                            <x-more-components.form-input-basic label="Riwayat Penyakit Santri" name="riwayat_penyakit"
                                value="{{ $santri->riwayat_penyakit }}" readonly="true" />

                            <!-- Status Santri -->
                            <x-more-components.form-input-basic label="Status Santri" name="status_santri"
                                value="{{ $santri->status_santri }}" readonly="true" />


                            <!-- Jenjang Santri -->
                            <div class="form-group">
                                <label>Jenjang</label> <br>
                                <p class="badge bg-primary">
                                    {{ $santri->kelas->jenjang->nama }}
                                </p>
                            </div>
                        </div>
                    @endif

                    @if ($formPage == 2)
                        <div class="col-lg-4 mb-2">
                            <x-more-components.form-input-basic label="Nama Ayah" name="nama_ayah"
                                value="{{ $wali->nama_ayah }}" readonly="true" />
                            <x-more-components.form-input-basic label="NIK Ayah" name="nik_ayah"
                                value="{{ $wali->nik_ayah }}" readonly="true" />
                            <x-more-components.form-input-basic label="Tempat Lahir Ayah" name="tempat_lahir_ayah"
                                value="{{ $wali->tempat_lahir_ayah }}" readonly="true" />
                            <x-more-components.form-input-basic label="Tanggal Lahir Ayah" name="tanggal_lahir_ayah"
                                value="{{ $wali->tanggal_lahir_ayah }}" readonly="true" />
                            <x-more-components.form-input-basic label="Pendidikan Ayah"
                                name="pendidikan_terakhir_ayah"
                                value="{{ ucfirst($wali->pendidikan_terakhir_ayah) }}" readonly="true" />
                            <x-more-components.form-input-basic label="Pekerjaan Ayah" name="pekerjaan_ayah"
                                value="{{ $wali->pekerjaan_ayah }}" readonly="true" />
                            <x-more-components.form-input-basic label="No. Telepon Ayah" name="no_telp_ayah"
                                value="{{ $wali->no_telp_ayah }}" readonly="true" />
                        </div>

                        <div class="col-lg-4 mb-2">
                            <x-more-components.form-input-basic label="Nama Ibu" name="nama_ibu"
                                value="{{ $wali->nama_ibu }}" readonly="true" />
                            <x-more-components.form-input-basic label="NIK Ibu" name="nik_ibu"
                                value="{{ $wali->nik_ibu }}" readonly="true" />
                            <x-more-components.form-input-basic label="Tempat Lahir Ibu" name="tempat_lahir_ibu"
                                value="{{ $wali->tempat_lahir_ibu }}" readonly="true" />
                            <x-more-components.form-input-basic label="Tanggal Lahir Ibu" name="tanggal_lahir_ibu"
                                value="{{ $wali->tanggal_lahir_ibu }}" readonly="true" />
                            <x-more-components.form-input-basic label="Pendidikan Ibu" name="pendidikan_terakhir_ibu"
                                value="{{ ucfirst($wali->pendidikan_terakhir_ibu) }}" readonly="true" />
                            <x-more-components.form-input-basic label="Pekerjaan Ibu" name="pekerjaan_ibu"
                                value="{{ $wali->pekerjaan_ibu }}" readonly="true" />
                            <x-more-components.form-input-basic label="No. Telepon Ibu" name="no_telp_ibu"
                                value="{{ $wali->no_telp_ibu }}" readonly="true" />
                        </div>

                        <div class="col-lg-4 mb-2">
                            <x-more-components.form-input-basic label="Provinsi" name="provinsi"
                                value="{{ $wali->provinsi }}" readonly="true" />
                            <x-more-components.form-input-basic label="Kabupaten" name="kabupaten"
                                value="{{ $wali->kabupaten }}" readonly="true" />
                            <x-more-components.form-input-basic label="Kecamatan" name="kecamatan"
                                value="{{ $wali->kecamatan }}" readonly="true" />
                            <x-more-components.form-input-basic label="Kelurahan" name="kelurahan"
                                value="{{ $wali->kelurahan }}" readonly="true" />
                            <x-more-components.form-input-basic label="RT/RW" name="rt_rw"
                                value="{{ $wali->rt }}/{{ $wali->rw }}" readonly="true" />
                            <x-more-components.form-input-basic label="Status Pernikahan" name="status_orang_tua"
                                value="{{ ucfirst($wali->status_orang_tua) }}" readonly="true" />
                        </div>
                        <div class="col-lg-12 mb-2">
                            <x-more-components.form-input-basic label="Alamat Lengkap" name="alamat"
                                value="{{ $wali->alamat }}" readonly="true" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
