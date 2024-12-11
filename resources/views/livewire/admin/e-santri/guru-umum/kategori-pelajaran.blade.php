<section>
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div wire:poll.4s class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="d-flex justify-content-end">
            <div wire:poll.4s class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Daftar Kategori Pelajaran</h5>
            <button wire:loading.attr='disabled'
                wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdateKategoriPelajaran"
                class="btn btn-primary">Tambah Kategori +</button>
        </div>

        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listKategoriPelajaran as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ Str::limit($kategori->deskripsi, 50) }}</td>
                            <td>
                                <button wire:loading.attr='disabled'
                                    wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                                    wire:click='edit("{{ $kategori->id }}")' data-bs-toggle="modal" data-bs-target="#createOrUpdateKategoriPelajaran"
                                    class="btn btn-warning btn-sm">Edit</button>

                                <button wire:loading.attr='disabled'
                                    wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                                    wire:click='deleteKategoriPelajaran("{{ $kategori->id }}")'
                                    class="btn btn-danger btn-sm"
                                    wire:confirm='Apakah kamu ingin menghapus kategori pelajaran ini?'>Delete</button>

                                <button wire:loading.attr='disabled'
                                    wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                                    wire:click='getDetailKategoriPelajaran("{{ $kategori->id }}")' data-bs-toggle="modal"
                                    data-bs-target="#detailKategoriPelajaran"
                                    class="btn btn-info btn-sm">Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada kategori pelajaran!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $listKategoriPelajaran->links() }}
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal fade" id="detailKategoriPelajaran" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kategori Pelajaran</h5>
                    <button wire:loading.attr='disabled'
                        wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                        type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($detailKategoriPelajaran)
                        <p class="mb-2"><b>Nama: </b> {{ $detailKategoriPelajaran->nama }}</p>
                        <p class="mb-2"><b>Deskripsi: </b> {{ $detailKategoriPelajaran->deskripsi }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create/Update --}}
    <div class="modal fade" wire:ignore.self id="createOrUpdateKategoriPelajaran" tabindex="-1"
         x-on:close-modal.window="bootstrap.Modal.getInstance($el).hide()">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form
                    wire:submit.prevent='{{ $kategoriPelajaranId ? 'updateKategoriPelajaran' : 'createKategoriPelajaran' }}'>
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $kategoriPelajaranId ? 'Edit Kategori Pelajaran' : 'Tambah Kategori Pelajaran' }}
                        </h5>
                        <button wire:loading.attr='disabled'
                            wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                            type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" required class="form-control"
                                wire:model.live="kategoriPelajaranForm.nama">
                            @error('kategoriPelajaranForm.nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" required wire:model.live="kategoriPelajaranForm.deskripsi"></textarea>
                            @error('kategoriPelajaranForm.deskripsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:loading.attr='disabled'
                            wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                            type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button wire:loading.attr='disabled'
                            wire:target='create, createKategoriPelajaran, edit, updateKategoriPelajaran, deleteKategoriPelajaran, getDetailKategoriPelajaran'
                            type="submit" class="btn {{ $kategoriPelajaranId ? 'btn-warning' : 'btn-primary' }}">
                            {{ $kategoriPelajaranId ? 'Update' : 'Tambah' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>