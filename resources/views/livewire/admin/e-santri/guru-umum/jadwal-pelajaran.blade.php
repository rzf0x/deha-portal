<section>
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="d-flex justify-content-end">
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Daftar Jadwal Pelajaran</h5>
            <button wire:loading.attr='disabled'
                wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                wire:click='create' data-bs-toggle="modal" data-bs-target="#createOrUpdateJadwalPelajaran"
                class="btn btn-primary">Tambah Jadwal +</button>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Kategori Pelajaran</th>
                        <th>Mata Pelajaran</th>
                        <th>Hari</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listJadwalPelajaran as $jadwal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->kelas->nama }}</td>
                            <td>{{ $jadwal->kategoriPelajaran->nama }}</td>
                            <td>{{ $jadwal->mata_pelajaran }}</td>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->waktu_mulai }}</td>
                            <td>{{ $jadwal->waktu_selesai }}</td>
                            <td>
                                <button wire:loading.attr='disabled'
                                    wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                                    wire:click='edit("{{ $jadwal->id }}")' data-bs-toggle="modal"
                                    data-bs-target="#createOrUpdateJadwalPelajaran"
                                    class="btn btn-warning btn-sm">Edit</button>

                                <button wire:loading.attr='disabled'
                                    wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                                    wire:click='deleteJadwalPelajaran("{{ $jadwal->id }}")'
                                    class="btn btn-danger btn-sm"
                                    wire:confirm='Apakah kamu ingin menghapus jadwal pelajaran ini?'>Delete</button>

                                <button wire:loading.attr='disabled'
                                    wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                                    class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailJadwalPelajaran"
                                    wire:click='detailJadwalPelajaran("{{ $jadwal->id }}")'>Detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Belum ada jadwal pelajaran!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $listJadwalPelajaran->links() }}
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal fade" id="detailJadwalPelajaran" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Jadwal Pelajaran</h5>
                    <button wire:loading.attr='disabled'
                        wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                        type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($detailJadwalPelajaranList)
                        <p class="mb-2"><b>Kelas: </b> {{ $detailJadwalPelajaranList->kelas->nama }}</p>
                        <p class="mb-2"><b>Kategori Pelajaran: </b>
                            {{ $detailJadwalPelajaranList->kategoriPelajaran->nama }}</p>
                        <p class="mb-2"><b>Mata Pelajaran: </b> {{ $detailJadwalPelajaranList->mata_pelajaran }}</p>
                        <p class="mb-2"><b>Hari: </b> {{ $detailJadwalPelajaranList->hari }}</p>
                        <p class="mb-2">
                            <b>Waktu: </b>
                            {{ $detailJadwalPelajaranList->waktu_mulai }} -
                            {{ $detailJadwalPelajaranList->waktu_selesai }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create/Update --}}
    <div class="modal fade" wire:ignore.self id="createOrUpdateJadwalPelajaran" tabindex="-1"
        x-on:close-modal.window="bootstrap.Modal.getInstance($el).hide()">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form
                    wire:submit.prevent='{{ $jadwalPelajaranId ? 'updateJadwalPelajaran' : 'createJadwalPelajaran' }}'>
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $jadwalPelajaranId ? 'Edit Jadwal Pelajaran' : 'Tambah Jadwal Pelajaran' }}
                        </h5>
                        <button wire:loading.attr='disabled'
                            wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                            type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select class="form-control" required wire:model.live="jadwalPelajaranForm.kelas_id">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelasList as $kelasItem)
                                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama }}</option>
                                @endforeach
                            </select>
                            @error('jadwalPelajaranForm.kelas_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori Pelajaran</label>
                            <select class="form-control" required
                                wire:model.live="jadwalPelajaranForm.kategori_pelajaran_id">
                                <option value="">Pilih Kategori Pelajaran</option>
                                @foreach ($kategoriPelajaranList as $kategoriItem)
                                    <option value="{{ $kategoriItem->id }}">{{ $kategoriItem->nama }}</option>
                                @endforeach
                            </select>
                            @error('jadwalPelajaranForm.kategori_pelajaran_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <input type="text" class="form-control" required
                                wire:model.live="jadwalPelajaranForm.mata_pelajaran">
                            @error('jadwalPelajaranForm.mata_pelajaran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control" required
                                wire:model.live="jadwalPelajaranForm.waktu_mulai">
                            @error('jadwalPelajaranForm.waktu_mulai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control" required
                                wire:model.live="jadwalPelajaranForm.waktu_selesai">
                            @error('jadwalPelajaranForm.waktu_selesai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <select class="form-control" required wire:model.live="jadwalPelajaranForm.hari">
                                <option value="">Pilih Hari</option>
                                @foreach ($hariList as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('jadwalPelajaranForm.hari')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:loading.attr='disabled'
                            wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                            type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button wire:loading.attr='disabled'
                            wire:target='create, createJadwalPelajaran, edit, updateJadwalPelajaran, deleteJadwalPelajaran, detailJadwalPelajaran'
                            type="submit" class="btn {{ $jadwalPelajaranId ? 'btn-warning' : 'btn-primary' }}">
                            {{ $jadwalPelajaranId ? 'Update' : 'Tambah' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>