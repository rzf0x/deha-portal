<div>
    {{-- A;ert Notification --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    {{-- #Alert Notification --}}

    <div class="card">
        <div class="card-body">
            {{-- CTA Tambah Data --}}
            <div class="d-flex justify-content-end gap-2 mb-2">
                {{-- Tambah Data to Excel --}}
                <button wire:click='create' type="button" class="btn btn-primary block" data-bs-toggle="modal"
                    data-bs-target="#modal-form">
                    <i class="bi bi-plus"></i>
                    <span class="ms-1">Tambah Data</span>
                </button>

                {{-- Import Data to Excel --}}
                <button type="button" class="btn btn-secondary block" data-bs-toggle="modal"
                    data-bs-target="#modal-import">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    <span class="ms-1">Import Data</span>
                </button>

                {{-- Export Data to Excel --}}
                <button type="button" class="btn btn-success block" wire:click='export'>
                    <i class="bi bi-file-earmark-excel"></i>
                    <span class="ms-1">Export Data</span>
                </button>
            </div>

            {{-- Modal CTA --}}
            <div class="modal fade text-left" id="modal-import" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload File Excel<h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="file" wire:model="file">
                                @error('file')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal"
                                wire:click.prevent="import">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">
                                    Import Data
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA Modal Form --}}
            <div class="modal fade text-left" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ $kamar_id ? 'Edit Data Wali Kamar' : 'Tambah Data Wali Kamar' }}
                                <h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-2">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" id="nama" class="form-control" wire:model="nama">
                                    @error('nama')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="kamar_tipe" class="form-label">Tipe Kamar</label>
                                    <select wire:model='kamar_tipe' id="kamar_tipe" class="form-select">
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="putera">Putera</option>
                                        <option value="puteri">Puteri</option>
                                    </select>
                                    @error('kamar_tipe')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="wali_kamar" class="form-label">Wali Kamar</label>
                                    <select wire:model='wali_kamar' id="wali_kamar" class="form-select">
                                        <option value="">-- Pilih Wali Kamar --</option>
                                        @foreach ($this->listWaliKamar as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('wali_kamar')
                                        <span class="error">{{ $message }}</span>
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
                                wire:click.prevent="store">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">
                                    {{ $kamar_id ? 'Edit Data' : 'Tambah Data' }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Nama Wali Kamar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->listKamar as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kamar_tipe }}</td>
                            <td>{{ $item->waliKamar->nama }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal"
                                        data-bs-target="#modal-form" class="btn btn-sm btn-warning">Edit</button>
                                    <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}"
                                        wire:click="delete({{ $item->id }})"
                                        class="btn btn-sm btn-danger">Delete</button>
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
                <div class="mx-3">
                    {{ $this->listKamar->links() }}
                </div>
        </div>

    </div>
</div>
