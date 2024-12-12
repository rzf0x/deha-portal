<section>
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div wire:poll class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="d-flex justify-content-end">
            <div wire:poll class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Daftar Pengumuman</h5>
            <button wire:loading.attr='disabled'
                wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdatePengumuman"
                class="btn btn-primary">Tambah Pengumuman +</button>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi Pengumuman</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listPengumuman as $pengumuman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengumuman->judul }}</td>
                            <td>{{ Str::limit($pengumuman->isi_pengumuman, 56, '...') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}</td>
                            <td>
                                <button wire:loading.attr='disabled'
                                    wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                                    wire:click='edit("{{ $pengumuman->id }}")' data-bs-toggle="modal"
                                    data-bs-target="#createOrUpdatePengumuman"
                                    class="btn btn-warning btn-sm">Edit</button>
                                <button wire:loading.attr='disabled'
                                    wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                                    wire:click='deletePengumuman("{{ $pengumuman->id }}")' class="btn btn-danger btn-sm"
                                    wire:confirm='Apakah kamu ingin menghapus "{{ $pengumuman->judul }}"?'>Delete</button>
                                <button wire:loading.attr='disabled'
                                    wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                                    class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailPengumuman"
                                    wire:click='detailPengumuman("{{ $pengumuman->id }}")'>Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Belum ada pengumuman!</td>
                        </tr>
                    @endforelse
                </tbody>
                {{ $listPengumuman->links() }}
            </table>
        </div>
    </div>

    <div class="modal fade" id="detailPengumuman" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengumuman</h5>
                    <button wire:loading.attr='disabled'
                        wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                        type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><b>Judul: </b> {{ $detailPengumumanSantri?->judul }}</p>
                    <p class="mb-2"><b>Isi Pengumuman: </b> {{ $detailPengumumanSantri?->isi_pengumuman }}</p>
                    <p class="mb-2"><b>Tanggal: </b>
                        {{ \Carbon\Carbon::parse($detailPengumumanSantri?->tanggal)->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="createOrUpdatePengumuman" tabindex="-1" x-on:close-modal.window="bootstrap.Modal.getInstance($el).hide()">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit.prevent='{{ $pengumumanId ? 'updatePengumuman' : 'createPengumuman' }}'>
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $pengumumanId ? 'Edit Pengumuman' : 'Pengumuman Baru' }}</h5>
                        <button wire:loading.attr='disabled'
                            wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                            type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" required wire:model.live="pengumumanForm.judul">
                            @error('pengumumanForm.judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control" required wire:model.live="pengumumanForm.isi_pengumuman"></textarea>
                            @error('pengumumanForm.isi_pengumuman')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control"
                                required wire:model.live="pengumumanForm.tanggal">
                            @error('pengumumanForm.tanggal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:loading.attr='disabled'
                            wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                            type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button wire:loading.attr='disabled'
                            wire:target='listPengumuman,create,createPengumuman,edit,updatePengumuman,deletePengumuman,detailPengumuman'
                            type="submit"
                            class="btn {{ $pengumumanId ? 'btn-warning' : 'btn-primary' }}">{{ $pengumumanId ? 'Update' : 'Tambah' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
