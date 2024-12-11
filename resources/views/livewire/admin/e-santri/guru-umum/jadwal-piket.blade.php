<section>
    @if (session()->has('error'))
        <div class="d-flex justify-content-end">
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="d-flex justify-content-end">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Jadwal Piket</h5>
            <button 
                wire:loading.attr='disabled' 
                wire:target='create,store,edit,update,delete' 
                wire:click="create"
                class="btn btn-primary" 
                data-bs-toggle="modal" 
                data-bs-target="#createOrUpdate">
                Tambah Jadwal Piket +
            </button>
        </div>
    
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-md-6 d-flex gap-2 mb-2 mb-md-0">
                    <input 
                        type="text" 
                        placeholder="Cari Santri" 
                        wire:model='searchSantri' 
                        class="form-control">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                
                <div class="col-12 col-md-6  d-flex gap-2 mt-2 mt-md-0">
                    <select wire:model.live="filter.kelas" class="form-control">
                        <option value="">Kelas</option>
                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                    
                    <select wire:model.live="filter.hari" class="form-control">
                        <option value="">Hari</option>
                        @foreach ($hariList as $hari)
                            <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalPikets as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jadwal->santri->nama }}</td>
                                <td>{{ $jadwal->kelas->nama }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->keterangan }}</td>
                                <td>{{ $jadwal->waktu }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button 
                                            wire:loading.attr='disabled' 
                                            wire:target='create,store,edit,update,delete'
                                            wire:click="edit({{ $jadwal->id }})" 
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#createOrUpdate">
                                            Edit
                                        </button>
                                        <button 
                                            wire:loading.attr='disabled' 
                                            wire:target='create,store,edit,update,delete'
                                            wire:click="delete({{ $jadwal->id }})"
                                            class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada jadwal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    
                {{ $jadwalPikets->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createOrUpdate" wire:ignore.self tabindex="-1" x-on:close-modal-createOrUpdate.window="bootstrap.Modal.getInstance($el).hide()">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditing ? 'Edit Jadwal Piket' : 'Tambah Jadwal Piket' }}</h5>
                    <button wire:loading.attr='disabled' wire:target='create,store,edit,update,delete' type="button"
                        class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="santri_id" class="form-label">Santri</label>
                            <select wire:model="jadwalPiketForm.santri_id" class="form-control" required>
                                <option value="">Pilih Santri</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}">{{ $santri->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select wire:model="jadwalPiketForm.kelas_id" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input wire:loading.attr='disabled' type="text" wire:model="jadwalPiketForm.keterangan"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <select wire:model="jadwalPiketForm.waktu" class="form-control" required>
                                <option value="">Pilih Waktu</option>
                                @foreach ($waktuList as $waktu)
                                    <option value="{{ $waktu }}">{{ $waktu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select wire:model="jadwalPiketForm.hari" class="form-control" required>
                                <option value="">Pilih Hari</option>
                                @foreach ($hariList as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:loading.attr='disabled' wire:target='create,store,edit,update,delete'
                            type="submit" class="btn btn-primary">{{ $isEditing ? 'Update' : 'Simpan' }}</button>
                        <button wire:loading.attr='disabled' wire:target='create,store,edit,update,delete'
                            type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
