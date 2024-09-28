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
                    <span class="ms-1">Tambah Data</span>
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
                                        <img src="{{ asset($item->foto) }}" class="img-fluid mx-auto" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                    @else
                                        <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}" class="img-fluid mx-auto" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->kelas->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $item->kelas->jenjang->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge text-black bg-warning">
                                        {{ $item->kamar->nama }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal"
                                            data-bs-target="#default" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit</button>
                                        <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}"
                                            wire:click="delete({{ $item->id }})"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                            Delete</button>
                                            <a href="{{ route('admin.master-santri.detail-santri', ['id' => $item->nism]) }}" wire:navigate>
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
                <div class="modal-header {{ $santri_id ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title {{ $santri_id ? 'text-dark' : 'text-white' }}">
                        {{ $santri_id ? 'Edit Santri' : 'Tambah Santri' }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row">
                        {{-- Nama --}}
                        <div class="form-group col-lg-4">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" id="nama"
                                placeholder="Ahmad Syakir">
                            @error('nama')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- NISN --}}
                        <div class="form-group col-lg-4">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" wire:model="nisn" id="nisn"
                                placeholder="3021312222012312">
                            @error('nisn')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- NISM --}}
                        <div class="form-group col-lg-4">
                            <label for="nism">NISM</label>
                            <input type="text" class="form-control" wire:model="nism" id="nism"
                                placeholder="20241021982">
                            @error('nism')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Kewarganegaraan --}}
                        <div class="form-group col-lg-4">
                            <label for="kewarganegaraan">Kewarganegaraan</label>
                            <input type="text" class="form-control" wire:model="kewarganegaraan" id="kewarganegaraan"
                                placeholder="Indonesia">
                            @error('kewarganegaraan')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="form-group col-lg-4">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" wire:model="nik" id="nik"
                                placeholder="30213129123">
                            @error('nik')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="form-group col-lg-4">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" wire:model="tempat_lahir" id="tempat_lahir"
                                placeholder="Karawang">
                            @error('tempat_lahir')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="form-group col-lg-4">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="text" class="form-control" wire:model="tanggal_lahir" id="tanggal_lahir"
                                placeholder="19-08-2012">
                            @error('tanggal_lahir')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="form-group col-lg-4">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-select" wire:model="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Jumlah Saudara Kandung --}}
                        <div class="form-group col-lg-4">
                            <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung </label>
                            <input type="text" class="form-control" wire:model="jumlah_saudara_kandung"
                                id="jumlah_saudara_kandung" placeholder="1">
                            @error('jumlah_saudara_kandung')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Anak Ke --}}
                        <div class="form-group col-lg-4">
                            <label for="anak_ke">Anak Ke</label>
                            <input type="text" class="form-control" wire:model="anak_ke" id="anak_ke"
                                placeholder="2">
                            @error('anak_ke')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Agama --}}
                        <div class="form-group col-lg-4">
                            <label for="agama">Agama</label>
                            <select class="form-select" wire:model="agama">
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam">Islam</option>
                            </select>

                            @error('agama')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Hobi --}}
                        <div class="form-group col-lg-4">
                            <label for="hobi">Hobi</label>
                            <select class="form-select" wire:model="hobi">
                                <option value="">-- Pilih Hobi --</option>
                                <option value="olahraga">olahraga</option>
                                <option value="kesenian">kesenian</option>
                                <option value="membaca">membaca</option>
                                <option value="menulis">menulis</option>
                                <option value="jalan-jalan">jalan-jalan</option>
                                <option value="lainnya">lainnya</option>
                            </select>

                            @error('hobi')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- NPSN --}}
                        <div class="form-group col-lg-4">
                            <label for="npsn">NPSN</label>
                            <input type="text" class="form-control" wire:model="npsn" id="npsn"
                                placeholder="70047049">
                            @error('npsn')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- No KIP --}}
                        <div class="form-group col-lg-4">
                            <label for="no_kip">No KIP</label>
                            <input type="text" class="form-control" wire:model="no_kip" id="no_kip"
                                placeholder="3172041912080001">
                            @error('no_kip')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- No KK --}}
                        <div class="form-group col-lg-4">
                            <label for="no_kk">No KK</label>
                            <input type="text" class="form-control" wire:model="no_kk" id="no_kk"
                                placeholder="3327070903170010">
                            @error('no_kk')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Nama Kepala Keluarga --}}
                        <div class="form-group col-lg-4">
                            <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control" wire:model="nama_kepala_keluarga"
                                id="nama_kepala_keluarga" placeholder="SARJIMIN">
                            @error('nama_kepala_keluarga')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal"
                        wire:click.prevent="store()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">
                            {{ $santri_id ? 'Update Data' : 'Tambah Data' }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
