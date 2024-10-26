<div>
    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-success w-25">
                {{ session('message') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-danger w-25">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <div class="filter-option d-flex">
                    <div class="form search px-4 border border-2 py-2 rounded-3">
                        <input class="bg-transparent" style="border: none; outline: none;" type="text"
                            wire:model.live="search" placeholder="Cari santri...">
                        <a href="#" class="search_icon">
                            <i class="bi bi-search"></i>
                        </a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                    <i class="bi bi-plus-circle"></i>
                    <span class="ms-1">Tambah Pembayaran</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Santri</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Status Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santris as $santri)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $santri->nama }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $santri->kelas?->nama ?? 'Belum ada kelas' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge text-black bg-warning">
                                        {{ $santri->kamar?->nama ?? 'Belum ada kamar' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('spp.detail-laporan-spp-santri', $santri->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-eye-fill"></i> Detail
                                        </a>
                                        <button
                                            wire:confirm="Yakin ingin menghapus data pembayaran {{ $santri->nama }}?"
                                            wire:click="delete({{ $santri->id }})" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    {{ $search ? 'Data tidak ditemukan!' : 'Tidak ada data yang ditampilkan' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $santris->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Form Pembayaran -->
    <div wire:ignore.self class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel" wire:click="resetForm">Tambah Pembayaran SPP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm"
                        aria-label="Close"></button>
                </div>
                <form wire:submit="createStore">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="santri" class="form-label">Pilih Santri</label>
                            <div class="dropdown">
                                <input type="text" class="form-control @error('santri_id') is-invalid @enderror"
                                    wire:model.live="searchSantri"
                                    onkeydown="{{ $this->getFilteredSantrisProperty() }}"
                                    placeholder="Cari nama santri..." autocomplete="off" data-bs-toggle="dropdown">

                                <ul class="dropdown-menu w-100" wire:ignore.self
                                    style="max-height: 200px; overflow-y: auto;">
                                    @forelse($this->filteredSantris as $santri)
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                wire:click.prevent="selectSantri('{{ $santri->id }}', '{{ $santri->nama }}')">
                                                {{ $santri->nama }}
                                                <small class="text-muted">
                                                    ({{ $santri->kelas?->nama ?? 'Tanpa Kelas' }})
                                                </small>
                                            </a>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item">Tidak ada santri ditemukan</span></li>
                                    @endforelse
                                </ul>
                            </div>
                            @error('santri_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if ($selectedSantri)
                                <div class="mt-2 p-2 border rounded">
                                    <p class="mb-1"><strong>Santri Terpilih:</strong></p>
                                    <p class="mb-1">Nama: {{ $selectedSantri->nama }}</p>
                                    <p class="mb-1">Kelas: {{ $selectedSantri->kelas?->nama ?? 'Belum ada kelas' }}
                                    </p>
                                    <p class="mb-0">Kamar: {{ $selectedSantri->kamar?->nama ?? 'Belum ada kamar' }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="tipe" class="form-label">Pilih Tipe Pembayaran</label>
                            <select class="form-select @error('pembayaran_tipe_id') is-invalid @enderror"
                                wire:model="pembayaran_tipe_id" id="tipe">
                                <option value="">Pilih Tipe Pembayaran...</option>
                                @foreach ($tipeList as $tipe)
                                    <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                                @endforeach
                            </select>
                            @error('pembayaran_tipe_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="timeline" class="form-label">Pilih Bulan</label>
                            <select class="form-select @error('pembayaran_timeline_id') is-invalid @enderror"
                                wire:model="pembayaran_timeline_id" id="timeline">
                                <option value="">Pilih Bulan...</option>
                                @foreach ($timelineList as $timeline)
                                    <option value="{{ $timeline->id }}">{{ $timeline->nama_bulan }}</option>
                                @endforeach
                            </select>
                            @error('pembayaran_timeline_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Pembayaran</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                    id="nominal" wire:model="nominal">
                            </div>
                            @error('nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode" class="form-label">Metode Pembayaran</label>
                            <select class="form-select @error('metode_pembayaran') is-invalid @enderror"
                                wire:model="metode_pembayaran" id="metode">
                                <option value="">Pilih Metode...</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                            @error('metode_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="resetForm">Tutup</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.class.remove='d-none'
                                class="d-none spinner-border spinner-border-sm"></span>
                            Simpan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        // Close modal event
        Livewire.on('close-modal', () => {
            bootstrap.Modal.getInstance(document.getElementById('formModal')).hide();
        });

        // Auto hide dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown')) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });
    });
</script>
