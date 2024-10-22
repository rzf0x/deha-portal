<div>
    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-success w-25">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button wire:click="create()" type="button" class="btn btn-primary block" data-bs-toggle="modal"
                    data-bs-target="#default">
                    <i class="bi bi-plus-circle"></i>
                    <span class="ms-1">Create Data</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Jenjang</th>
                            <th>Kamar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getData as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td style="width: 120px;">
                                    @if ($item->foto)
                                        <img src="{{ asset($item->foto) }}" class="img-fluid mx-auto"
                                            style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                    @else
                                        <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}"
                                            class="img-fluid mx-auto"
                                            style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->kelas?->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $item->kelas?->jenjang?->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge text-black bg-warning">
                                        {{ $item->kamar?->nama }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal"
                                            data-bs-target="#default" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit</button>
                                        <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}"
                                            wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                            Delete</button>
                                        <a href="{{ route('admin.master-santri.detail-santri', ['id' => $item->nism]) }}"
                                            wire:navigate>
                                            <button class="btn btn-sm btn-success text-white">
                                                <i class="bi bi-eye-fill"></i> Detail
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data yang di tampilkan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $this->getData->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header {{ $santriEditId ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title {{ $santriEditId ? 'text-dark' : 'text-white' }}">
                        {{ $santriEditId ? 'Edit' : 'Create ' . ($formCount == 1 ? 'Santri' : ($formCount == 2 ? 'Orang Tua' : 'Alamat')) }}
                    </h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent={{ $santriEditId ? 'editStore' : 'createStore' }} class="row">
                        @if ($formCount == 1)
                            <div class="santri-data row">
                                {{-- Nama --}}
                                <div class="form-group col-lg-4">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" wire:model="santriForm.nama"
                                        id="nama" placeholder="Ahmad Syakir">
                                    @error('santriForm.nama')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NISN --}}
                                <div class="form-group col-lg-4">
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" wire:model="santriForm.nisn"
                                        id="nisn" placeholder="3021312222012312">
                                    @error('santriForm.nisn')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NISM --}}
                                <div class="form-group col-lg-4">
                                    <label for="nism">NISM</label>
                                    <input type="text" class="form-control" wire:model="santriForm.nism"
                                        id="nism" placeholder="20241021982">
                                    @error('santriForm.nism')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kewarganegaraan --}}
                                <div class="form-group col-lg-4">
                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                    <select class="form-select" wire:model="santriForm.kewarganegaraan">
                                        <option value="">-- Kewarganegaraan --</option>
                                        <option value="wni">WNI</option>
                                        <option value="wna">WNA</option>
                                    </select>
                                    @error('santriForm.kewarganegaraan')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NIK --}}
                                <div class="form-group col-lg-4">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" wire:model="santriForm.nik"
                                        id="nik" placeholder="30213129123">
                                    @error('santriForm.nik')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Riwayat Penyakit --}}
                                <div class="form-group col-lg-4">
                                    <label for="riwayat_penyakit">Riwayat Penyakit</label>
                                    <select class="form-select" wire:model="santriForm.riwayat_penyakit">
                                        <option value="">-- Riwayat Penyakit --</option>
                                        <option value="sehat">sehat</option>
                                        <option value="kurang_sehat">kurang sehat</option>
                                    </select>

                                    @error('santriForm.riwayat_penyakit')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Tempat Lahir --}}
                                <div class="form-group col-lg-4">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" wire:model="santriForm.tempat_lahir"
                                        id="tempat_lahir" placeholder="Karawang">
                                    @error('santriForm.tempat_lahir')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Tanggal Lahir --}}
                                <div class="form-group col-lg-4">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" wire:model="santriForm.tanggal_lahir"
                                        id="tanggal_lahir" placeholder="19-08-2012">
                                    @error('santriForm.tanggal_lahir')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Jenis Kelamin --}}
                                <div class="form-group col-lg-4">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select" wire:model="santriForm.jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                    @error('santriForm.jenis_kelamin')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Jumlah Saudara Kandung --}}
                                <div class="form-group col-lg-4">
                                    <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung </label>
                                    <input type="text" class="form-control"
                                        wire:model="santriForm.jumlah_saudara_kandung" id="jumlah_saudara_kandung"
                                        placeholder="1">
                                    @error('santriForm.jumlah_saudara_kandung')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Anak Ke --}}
                                <div class="form-group col-lg-4">
                                    <label for="anak_ke">Anak Ke</label>
                                    <input type="text" class="form-control" wire:model="santriForm.anak_ke"
                                        id="anak_ke" placeholder="2">
                                    @error('santriForm.anak_ke')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Agama --}}
                                {{-- <div class="form-group col-lg-4">
                                <label for="agama">Agama</label>
                                <select class="form-select" wire:model="santriForm.agama">
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="islam">Islam</option>
                                </select>

                                @error('santriForm.agama')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div> --}}

                                {{-- Hobi --}}
                                <div class="form-group col-lg-4">
                                    <label for="nisn">Hobi</label>
                                    <input type="text" class="form-control" wire:model="santriForm.hobi"
                                        id="hobi" placeholder="Main Bola">

                                    @error('santriForm.hobi')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Aktivitas Pendidikan --}}
                                <div class="form-group col-lg-4">
                                    <label for="aktivitas_pendidikan">Aktivitas Pendidikan</label>
                                    <select class="form-select" wire:model="santriForm.aktivitas_pendidikan">
                                        <option value="">-- Aktivitas Pendidikan --</option>
                                        <option value="aktif">aktif</option>
                                        <option value="nonaktif">nonaktif</option>
                                    </select>
                                    @error('santriForm.aktivitas_pendidikan')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NPSN --}}
                                <div class="form-group col-lg-4">
                                    <label for="npsn">NPSN</label>
                                    <input type="text" class="form-control" wire:model="santriForm.npsn"
                                        id="npsn" placeholder="70047049">
                                    @error('santriForm.npsn')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- No KIP --}}
                                <div class="form-group col-lg-4">
                                    <label for="no_kip">No KIP</label>
                                    <input type="text" class="form-control" wire:model="santriForm.no_kip"
                                        id="no_kip" placeholder="3172041912080001">
                                    @error('santriForm.no_kip')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- No KK --}}
                                <div class="form-group col-lg-4">
                                    <label for="no_kk">No KK</label>
                                    <input type="text" class="form-control" wire:model="santriForm.no_kk"
                                        id="no_kk" placeholder="3327070903170010">
                                    @error('santriForm.no_kk')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status Kesantrian --}}
                                <div class="form-group col-lg-4">
                                    <label for="status_kesantrian">Status Kesantrian</label>
                                    <select class="form-select" wire:model="santriForm.status_kesantrian">
                                        <option value="aktif">aktif</option>
                                        <option value="nonaktif">nonaktif</option>
                                    </select>

                                    @error('santriForm.status_kesantrian')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status Santri --}}
                                <div class="form-group col-lg-4">
                                    <label for="status_santri">Status Santri</label>
                                    <select class="form-select" wire:model="santriForm.status_santri">
                                        <option value="">-- Status Santri --</option>
                                        <option value="reguler">reguler</option>
                                        <option value="yatim">yatim</option>
                                        <option value="yatim_piatu">yatim piatu</option>
                                    </select>

                                    @error('santriForm.status_santri')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kelas --}}
                                <div class="form-group col-lg-4">
                                    <label for="kelas_id">Kelas</label>
                                    <select class="form-select" wire:model="santriForm.kelas_id">
                                        <option value="">-- Kelas --</option>
                                        @foreach ($kelas as $kelas)
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('santriForm.kelas_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Semester --}}
                                <div class="form-group col-lg-4">
                                    <label for="semester_id">Semester</label>
                                    <select class="form-select" wire:model="santriForm.semester_id">
                                        <option value="">-- Semester --</option>
                                        @foreach ($semester as $semester)
                                            <option value="{{ $semester->id }}">{{ $semester->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('santriForm.semester_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Angkatan --}}
                                <div class="form-group col-lg-4">
                                    <label for="angkatan_id">Angkatan</label>
                                    <select class="form-select" wire:model="santriForm.angkatan_id">
                                        <option value="">-- Angkatan --</option>
                                        @foreach ($angkatan as $angkatan)
                                            <option value="{{ $angkatan->id }}">{{ $angkatan->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('santriForm.angkatan_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kamar --}}
                                <div class="form-group col-lg-4">
                                    <label for="kamar_id">Kamar</label>
                                    <select class="form-select" wire:model="santriForm.kamar_id">
                                        <option value="">-- Kamar --</option>
                                        @foreach ($kamar as $kamar)
                                            <option value="{{ $kamar->id }}">{{ $kamar->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('santriForm.kamar_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Nama Kepala Keluarga --}}
                                <div class="form-group col-lg-4">
                                    <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control"
                                        wire:model="santriForm.nama_kepala_keluarga" id="nama_kepala_keluarga"
                                        placeholder="SARJIMIN">
                                    @error('santriForm.nama_kepala_keluarga')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Asal Sekolah --}}
                                <div class="form-group col-lg-4">
                                    <label for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" class="form-control" wire:model="santriForm.asal_sekolah"
                                        id="asal_sekolah" placeholder="SMKN 1 Kota Bekasi">
                                    @error('santriForm.asal_sekolah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Yang Membiayai Sekolah --}}
                                <div class="form-group col-lg-4">
                                    <label for="yang_membiayai_sekolah">Yang Membiayai Sekolah</label>
                                    <input type="text" class="form-control"
                                        wire:model="santriForm.yang_membiayai_sekolah" id="yang_membiayai_sekolah"
                                        placeholder="Bapak">
                                    @error('santriForm.yang_membiayai_sekolah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @elseif ($formCount == 2)
                            <div class="wali-data row">
                                {{-- Nama Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.nama_ayah"
                                        id="nama_ayah" placeholder="Subarno">
                                    @error('waliSantriForm.nama_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="status_ayah">Status Ayah</label>
                                    <select class="form-select" wire:model="waliSantriForm.status_ayah">
                                        <option value="">-- Status --</option>
                                        <option value="hidup">hidup</option>
                                        <option value="meninggal">meninggal</option>
                                    </select>
                                    @error('waliSantriForm.status_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kewarganegaraan Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="kewarganegaraan_ayah">Kewarganegaraan Ayah</label>
                                    <select class="form-select" wire:model="waliSantriForm.kewarganegaraan_ayah">
                                        <option value="">-- Kewarganegaraan --</option>
                                        <option value="wni">WNI</option>
                                        <option value="wna">WNA</option>
                                    </select>
                                    @error('waliSantriForm.kewarganegaraan_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NIK Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="nik_ayah">NIK Ayah</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.nik_ayah"
                                        id="nik_ayah" placeholder="006152172193719">
                                    @error('waliSantriForm.nik_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Tempat Lahir Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.tempat_lahir_ayah" id="tempat_lahir_ayah"
                                        placeholder="DKI Jakarta">
                                    @error('waliSantriForm.tempat_lahir_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Tanggal Lahir Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                                    <input type="date" class="form-control"
                                        wire:model="waliSantriForm.tanggal_lahir_ayah" id="tanggal_lahir_ayah"
                                        placeholder="DKI Jakarta">
                                    @error('waliSantriForm.tanggal_lahir_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pendidikan Terakhir Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="pendidikan_terakhir_ayah">Pendidikan Terakhir Ayah</label>
                                    <select class="form-select" wire:model="waliSantriForm.pendidikan_terakhir_ayah">
                                        <option value="">-- Pendidikan --</option>
                                        <option value="sd">SD</option>
                                        <option value="smp">SMP</option>
                                        <option value="sma">SMA</option>
                                        <option value="slta">SLTA</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="sarjana">Sarjana</option>
                                    </select>
                                    @error('waliSantriForm.pendidikan_terakhir_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pekerjaan Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.pekerjaan_ayah" id="pekerjaan_ayah"
                                        placeholder="Programmer">
                                    @error('waliSantriForm.pekerjaan_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Penghasilan Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.penghasilan_ayah" id="penghasilan_ayah"
                                        placeholder="1000000">
                                    @error('waliSantriForm.penghasilan_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- No Telp Ayah --}}
                                <div class="form-group col-lg-4">
                                    <label for="no_telp_ayah">No Telp Ayah</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.no_telp_ayah" id="no_telp_ayah"
                                        placeholder="+62888....">
                                    @error('waliSantriForm.no_telp_ayah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Nama Ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.nama_ibu"
                                        id="nama_ibu" placeholder="Subarno">
                                    @error('waliSantriForm.nama_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status Ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="status_ibu">Status Ibu</label>
                                    <select class="form-select" wire:model="waliSantriForm.status_ibu">
                                        <option value="">-- Status --</option>
                                        <option value="hidup">hidup</option>
                                        <option value="meninggal">meninggal</option>
                                    </select>
                                    @error('waliSantriForm.status_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- NIK ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="nik_ibu">NIK ibu</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.nik_ibu"
                                        id="nik_ibu" placeholder="006152172193719">
                                    @error('waliSantriForm.nik_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Tempat Lahir ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="tempat_lahir_ibu">Tempat Lahir ibu</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.tempat_lahir_ibu" id="tempat_lahir_ibu"
                                        placeholder="DKI Jakarta">
                                    @error('waliSantriForm.tempat_lahir_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kewarganegaraan ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="kewarganegaraan_ibu">Kewarganegaraan ibu</label>
                                    <select class="form-select" wire:model="waliSantriForm.kewarganegaraan_ibu">
                                        <option value="">-- Kewarganegaraan --</option>
                                        <option value="wni">WNI</option>
                                        <option value="wna">WNA</option>
                                    </select>
                                    @error('waliSantriForm.kewarganegaraan_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Tanggal Lahir ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="tanggal_lahir_ibu">Tanggal Lahir ibu</label>
                                    <input type="date" class="form-control"
                                        wire:model="waliSantriForm.tanggal_lahir_ibu" id="tanggal_lahir_ibu"
                                        placeholder="DKI Jakarta">
                                    @error('waliSantriForm.tanggal_lahir_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pendidikan Terakhir ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="pendidikan_terakhir_ibu">Pendidikan Terakhir ibu</label>
                                    <select class="form-select" wire:model="waliSantriForm.pendidikan_terakhir_ibu">
                                        <option value="">-- Pendidikan --</option>
                                        <option value="sd">SD</option>
                                        <option value="smp">SMP</option>
                                        <option value="sma">SMA</option>
                                        <option value="slta">SLTA</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="sarjana">Sarjana</option>
                                    </select>
                                    @error('waliSantriForm.pendidikan_terakhir_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pekerjaan ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="pekerjaan_ibu">Pekerjaan ibu</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.pekerjaan_ibu" id="pekerjaan_ibu"
                                        placeholder="Programmer">
                                    @error('waliSantriForm.pekerjaan_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{-- Penghasilan ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="penghasilan_ibu">Penghasilan ibu</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.penghasilan_ibu" id="penghasilan_ibu"
                                        placeholder="1000000">
                                    @error('waliSantriForm.penghasilan_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- No Telp ibu --}}
                                <div class="form-group col-lg-4">
                                    <label for="no_telp_ibu">No Telp ibu</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.no_telp_ibu" id="no_telp_ibu"
                                        placeholder="+62888....">
                                    @error('waliSantriForm.no_telp_ibu')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @elseif ($formCount == 3)
                            <div class="alamat-data row">
                                {{-- Status Kepemilikan Rumah --}}
                                <div class="form-group col-lg-4">
                                    <label for="status_kepemilikan_rumah">Status Kepemilikan Rumah</label>
                                    <input type="text" class="form-control"
                                        wire:model="waliSantriForm.status_kepemilikan_rumah"
                                        id="status_kepemilikan_rumah" placeholder="Pribadi">
                                    @error('waliSantriForm.status_kepemilikan_rumah')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Provinsi --}}
                                <div class="form-group col-lg-4">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.provinsi"
                                        id="provinsi" placeholder="">
                                    @error('waliSantriForm.provinsi')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kabupaten --}}
                                <div class="form-group col-lg-4">
                                    <label for="kabupaten">Kabupaten</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.kabupaten"
                                        id="kabupaten" placeholder="">
                                    @error('waliSantriForm.kabupaten')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kecamatan --}}
                                <div class="form-group col-lg-4">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.kecamatan"
                                        id="kecamatan" placeholder="">
                                    @error('waliSantriForm.kecamatan')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kelurahan --}}
                                <div class="form-group col-lg-4">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.kelurahan"
                                        id="kelurahan" placeholder="">
                                    @error('waliSantriForm.kelurahan')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- RT --}}
                                <div class="form-group col-lg-4">
                                    <label for="rt">RT</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.rt"
                                        id="rt" placeholder="">
                                    @error('waliSantriForm.rt')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- RW --}}
                                <div class="form-group col-lg-4">
                                    <label for="rw">RW</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.rw"
                                        id="rw" placeholder="">
                                    @error('waliSantriForm.rw')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="form-group col-lg-4">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.alamat"
                                        id="alamat" placeholder="">
                                    @error('waliSantriForm.alamat')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Kode Pos --}}
                                <div class="form-group col-lg-4">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" class="form-control" wire:model="waliSantriForm.kode_pos"
                                        id="kode_pos" placeholder="">
                                    @error('waliSantriForm.kode_pos')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Status Orang Tua --}}
                                <div class="form-group col-lg-4">
                                    <label for="status_orang_tua">Status Orang Tua</label>
                                    <select class="form-select" wire:model="waliSantriForm.status_orang_tua">
                                        <option value="">-- Status Orang Tua --</option>
                                        <option value="kawin">kawin</option>
                                        <option value="cerai hidup">cerai hidup</option>
                                        <option value="cerai mati">cerai mati</option>
                                    </select>
                                    @error('waliSantriForm.status_orang_tua')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="modal-footer d-flex justify-content-between">
                            <div class="paginate_form">
                                <button {{ $formCount == 1 ? 'disabled' : '' }} type="button"
                                    wire:click='prevFormCount' class="btn">
                                    <span class="d-none d-sm-block">Prev</span>
                                </button>
                                <button {{ $formCount == 3 ? 'disabled' : '' }} type="button"
                                    wire:click='nextFormCount' class="btn">
                                    <span class="d-none text-primary d-sm-block">Next</span>
                                </button>
                            </div>
                            <div class="btn-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">
                                        {{ $santriEditId ? 'Update Data' : 'Create Data' }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
