<div>

    <div class="d-flex mb-2">
        <button class="btn btn-primary">
            <i class="bi bi-arrow-left-circle-fill"></i>
            Kembali ke list santri
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-2 text-center">
                    @if ($santri->foto)
                        <img src="{{ asset($santri->foto) }}" class="img-fluid w-75 mx-auto" alt="">
                    @else
                        <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}" class="img-fluid rounded-3 w-75 mx-auto"
                            alt="">
                    @endif

                    <div class="mt-2">
                        {{-- Status Kesantrian --}}
                        <p>
                            Status kesantrian :
                            <span class="badge {{ $santri->status_kesantrian == 'aktif' ? 'bg-primary' : 'bg-secondary' }}">
                                {{ $santri->status_kesantrian }}
                            </span>
                        </p>
                    </div>

                </div>
                <div class="col-lg-8 row mb-2">
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
                            name="aktivitas_pendidikan" value="{{ $santri->aktivitas_pendidikan }}" readonly="true" />

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
                            value="{{ $santri->jenis_kelamin }}" readonly="true" />

                        <!-- No KIP Santri -->
                        <x-more-components.form-input-basic label="No KIP Santri" name="no_kip"
                            value="{{ $santri->no_kip }}" readonly="true" />

                        <!-- No KK Santri -->
                        <x-more-components.form-input-basic label="No KK Santri" name="no_kk"
                            value="{{ $santri->no_kk }}" readonly="true" />

                        <!-- Nama Kepala Keluarga Santri -->
                        <x-more-components.form-input-basic label="Nama Kepala Keluarga Santri"
                            name="nama_kepala_keluarga" value="{{ $santri->nama_kepala_keluarga }}" readonly="true" />

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
                        <x-more-components.form-input-basic label="Jumlah Saudara Kandung" name="jumlah_saudara_kandung"
                            value="{{ $santri->jumlah_saudara_kandung }} Saudara" readonly="true" />

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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
