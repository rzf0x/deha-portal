<div class="overflow-hidden mt-4">

    <div class="card p-3">
        <a href="/admin/dashboard">
            <i class="bi bi-arrow-left fs-6"></i>
        </a>
    </div>

    <h3>List Jenjang</h3>

    <div class="row">

        @forelse ($this->listJenjang as $item)
        <div class="col-6">
            <div class="card">
                <p class="card-header">Nama Jenjang</p>
                <div class="card-body ">
                    <p class="fs-6 text-info font-semibold">
                        {{ $item->nama }}
                    </p>

                    <div class="d-flex justify-content-between">
                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#default"
                            class="btn btn-sm btn-warning rounded-3">Edit</button>
                        <button wire:confirm="Yakin ingin menghapus data {{ $item->nama }}" wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger rounded-3">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center">
                Tidak ada data yang ditampilkan
            </div>
        @endforelse

    </div>

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header {{ $jenjang_id ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title {{ $jenjang_id ? 'text-dark' : 'text-white' }}">{{ $jenjang_id ? 'Edit Jenjang' : 'Tambah Jenjang' }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" id="nama"
                                placeholder="Enter Nama">
                            @error('nama')
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
                            {{ $jenjang_id ? 'Update Data' : 'Tambah Data' }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
