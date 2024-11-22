<section>
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div wire:poll class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="card border-0 mb-0">
        <div class="card-header bg-transparent">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fs-5 mb-0">Daftar Kegiatan</h5>
                <button wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdateKegiatan"
                    class="btn btn-primary">Tambah Kegiatan +</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Isi Kegiatan</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->listKegiatan() as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan->judul }}</td>
                                <td>{{ Str::limit($kegiatan->isi_kegiatan, 56, '...') }}</td>
                                <td>{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('d M Y H:i') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('d M Y H:i') }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#createOrUpdateKegiatan"
                                            wire:click='edit("{{ $kegiatan->id }}")'>Edit</button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click='deleteKegiatan("{{ $kegiatan->id }}")'
                                            wire:confirm='Apakah kamu ingin menghapus "{{ $kegiatan->judul }}"?'>Delete</button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailKegiatan"
                                            wire:click='detailKegiatan("{{ $kegiatan->id }}")'>Detail</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                    <p class="m-0">Belum ada kegiatan!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailKegiatan" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><b>Judul: </b> {{ $detailKegiatanSantri?->judul }}</p>
                    <p class="mb-2"><b>Isi Kegiatan: </b> {{ $detailKegiatanSantri?->isi_kegiatan }}</p>
                    <p class="mb-2"><b>Waktu Mulai: </b>
                        {{ \Carbon\Carbon::parse($detailKegiatanSantri?->waktu_mulai)->format('d M Y H:i') }}</p>
                    <p class="mb-2"><b>Waktu Selesai: </b>
                        {{ \Carbon\Carbon::parse($detailKegiatanSantri?->waktu_selesai)->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="createOrUpdateKegiatan" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $kegiatanId ? 'Update Kegiatan' : 'Kegiatan Baru' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent='{{ $kegiatanId ? 'updateKegiatan' : 'createKegiatan' }}'>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="judul" class="form-label">Judul Kegiatan</label>
                            <input type="text" class="form-control" id="judul"
                                wire:model.live="kegiatanForm.judul" placeholder="Judul Kegiatan" required>
                            @error('kegiatanForm.judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="isi_kegiatan" class="form-label">Isi Kegiatan</label>
                            <textarea class="form-control" id="isi_kegiatan" wire:model.live="kegiatanForm.isi_kegiatan"
                                placeholder="Deskripsi Kegiatan"></textarea>
                            @error('kegiatanForm.isi_kegiatan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control" id="waktu_mulai"
                                wire:model.live="kegiatanForm.waktu_mulai" required>
                            @error('kegiatanForm.waktu_mulai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control" id="waktu_selesai"
                                wire:model.live="kegiatanForm.waktu_selesai" required>
                            @error('kegiatanForm.waktu_selesai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit"
                            class="btn {{ $kegiatanId ? 'btn-warning' : 'btn-primary' }}">{{ $kegiatanId ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
