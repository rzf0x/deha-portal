<div>

    {{-- <x-more-components.alert message="hello" /> --}}

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
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Jenjang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getData as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->waliKelas->nama }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $item->jenjang->nama }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal"
                                            data-bs-target="#default" class="btn btn-sm btn-warning">Edit</button>
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
                {{ $this->getData->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header {{ $kelasId ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title {{ $kelasId ? 'text-dark' : 'text-white' }}">{{ $kelasId ? 'Edit Kelas' : 'Tambah Kelas' }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- Nama Kelas --}}
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="namaKelas" id="namaKelas"
                                placeholder="Enter nama kelas">
                            @error('namaKelas')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Wali Kelas --}}
                        <div class="form-group">
                            <label for="nama">Wali Kelas</label>
                            <select class="form-control" wire:model="waliKelasId" id="">
                                <option value="">-- PIlih Wali Kelas --</option>
                                @forelse ($waliKelas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>
                                @empty
                                    <p class="text-center text-danger">Data tidak ada</p>
                                @endforelse
                            </select>
                        </div>

                        {{-- Jenjang --}}
                        <div class="form-group">
                            <label for="nama">Wali Kelas</label>
                            <select class="form-control" wire:model="jenjangId" id="">
                                <option value="">-- PIlih Jenjang --</option>
                                @forelse ($jenjang as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>
                                @empty
                                    <p class="text-center text-danger">Data tidak ada</p>
                                @endforelse
                            </select>
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
                            {{ $kelasId ? 'Update Data' : 'Tambah Data' }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
