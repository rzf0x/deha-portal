<div>
    @if (session()->has('message'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 3000)"
             class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex gap-3">
                    <select wire:model.live="jenjangFilter" class="form-select">
                        <option value="">Semua Jenjang</option>
                        @foreach ($jenjangOptions as $jenjang)
                            <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="tipePembayaranFilter" class="form-select">
                        <option value="">Semua Tipe</option>
                        @foreach ($tipePembayaranOptions as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>

                <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemPembayaranModal">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Jenjang</th>
                            <th>Tipe Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getFilteredData as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>{{ $item->jenjang->nama ?? 'N/A' }}</td>
                                <td>{{ $item->pembayaranTipe->nama }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button 
                                            wire:click="edit({{ $item->id }})" 
                                            class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#itemPembayaranModal">
                                            Edit
                                        </button>
                                        <button 
                                            wire:confirm="Yakin ingin menghapus data {{ $item->nama }}?"
                                            wire:click="delete({{ $item->id }})" 
                                            class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="itemPembayaranModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header {{ $itemPembayaranId ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title">
                        {{ $itemPembayaranId ? 'Edit' : 'Tambah' }} Item Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input 
                                type="text" 
                                class="form-control @error('ItemPembayaranForm.nama') is-invalid @enderror" 
                                wire:model="ItemPembayaranForm.nama">
                            @error('ItemPembayaranForm.nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nominal</label>
                            <input 
                                type="number" 
                                class="form-control @error('ItemPembayaranForm.nominal') is-invalid @enderror" 
                                wire:model="ItemPembayaranForm.nominal">
                            @error('ItemPembayaranForm.nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipe Pembayaran</label>
                            <select 
                                class="form-control @error('ItemPembayaranForm.pembayaran_tipe_id') is-invalid @enderror" 
                                wire:model="ItemPembayaranForm.pembayaran_tipe_id">
                                <option value="">Pilih Tipe Pembayaran</option>
                                @foreach ($tipePembayaranOptions as $id => $nama)
                                    <option value="{{ $id }}">{{ $nama }}</option>
                                @endforeach
                            </select>
                            @error('ItemPembayaranForm.pembayaran_tipe_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenjang</label>
                            <select 
                                class="form-control @error('ItemPembayaranForm.jenjang_id') is-invalid @enderror" 
                                wire:model="ItemPembayaranForm.jenjang_id">
                                <option value="">Pilih Jenjang</option>
                                @foreach ($jenjangOptions as $jenjang)
                                    <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                                @endforeach
                            </select>
                            @error('ItemPembayaranForm.jenjang_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        // Close modal event
        Livewire.on('modal', () => {
            bootstrap.Modal.getInstance(document.getElementById('itemPembayaranModal')).hide();
        });
    });
</script>