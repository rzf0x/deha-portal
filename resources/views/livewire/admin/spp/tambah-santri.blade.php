<div>
    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-success w-25">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Filter Section -->
                <div class="d-flex gap-3">
                    <!-- Search Form -->
                    <div class="position-relative d-flex">
                        <form wire:submit="cariSantri" class="d-flex w-100">
                            <input type="text" wire:model="search" placeholder="Cari santri..."
                                class="form-control border border-2 rounded-start-3 py-2" style="width: 250px;">
                            <button type="submit" class="btn btn-outline-secondary border-0 rounded-end-3 py-2">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Jenjang Dropdown -->
                    <select wire:model="filterList.jenjang" wire:change="cariSantri"
                        class="form-select py-2 rounded-3 border-2" wire:loading.attr="disabled">
                        <option value="">Pilih Jenjang</option>
                        @foreach ($jenjangOptions as $jenjang)
                            <option value="{{ $jenjang->nama }}">{{ $jenjang->nama }}</option>
                        @endforeach
                    </select>

                    <!-- Kelas Dropdown -->
                    <select wire:model="filterList.kelas" wire:change="cariSantri"
                        class="form-select py-2 rounded-3 border-2" wire:loading.attr="disabled">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelasOptions as $kelas)
                            <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>

                    <select wire:model="filterList.tahun" wire:change="cariSantri"
                        class="form-select py-2 rounded-3 border-2" wire:loading.attr="disabled">
                        <option value="">Pilih Tahun</option>
                        @foreach ($tahunOptions as $tahun)
                            <option value="{{ $tahun->nama_tahun }}">{{ $tahun->nama_tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Button Tambah SPP -->
                <button type="button" class="btn btn-primary d-flex align-items-center gap-2 py-2 px-3 rounded-3"
                    wire:click="$dispatch('prepareModal')" data-bs-toggle="modal" data-bs-target="#formModal">
                    <i class="bi bi-plus-circle" style="height: initial"></i>
                    <span>Tambah SPP</span>
                </button>
            </div>


            <div class="table-responsive">
                {{ $santris->links() }}

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Santri</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santris as $index => $santri)
                            <tr>
                                <td class="text-center">{{ $santris->firstItem() + $index }}</td>
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
                                        <button wire:confirm="Yakin ingin menghapus data spp {{ $santri->nama }}?"
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
            </div>
        </div>
    </div>

    <!-- Modal Form Spp -->
    <div wire:ignore.self class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel" wire:click="resetForm">Tambah SPP Santri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm"
                        aria-label="Close"></button>
                </div>
                <div>
                    @error('messageError')
                        <div class="alert alert-danger m-3">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="santri" class="form-label">
                                Pilih Santri
                                <span wire:loading.class.remove="d-none"
                                    class="d-none spinner-border spinner-border-sm"></span>
                            </label>
                            <form wire:submit.prevent="filterTambahSantris">
                                <div class="d-flex gap-3 mb-3">
                                    <!-- Dropdown Jenjang -->
                                    <select wire:model="filterTambah.jenjang" wire:change='filterTambahSantris'
                                        class="form-select" wire:loading.attr="disabled">
                                        <option value="">Pilih Jenjang</option>
                                        @foreach ($jenjangOptions as $jenjang)
                                            <option value="{{ $jenjang->nama }}">{{ $jenjang->nama }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Dropdown Kelas -->
                                    <select wire:model="filterTambah.kelas" wire:change='filterTambahSantris'
                                        class="form-select" wire:loading.attr="disabled">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($kelasOptions as $kelas)
                                            <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                                        @endforeach
                                    </select>

                                    <select wire:model="filterTambah.tahun" wire:change='filterTambahSantris'
                                        class="form-select" wire:loading.attr="disabled">
                                        <option value="">Pilih Tahun</option>
                                        @foreach ($tahunOptions as $tahun)
                                            <option value="{{ $tahun->nama_tahun }}">{{ $tahun->nama_tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Input Pencarian -->
                                <div class="input-group mb-3">
                                    <input type="text" wire:model="searchSantri" class="form-control"
                                        placeholder="Cari nama santri..." autocomplete="off">
                                    <button type="submit" class="btn btn-primary">Cari Santri</button>
                                </div>
                            </form>

                            <!-- Hasil Pencarian -->
                            <ul class="list-group" style="max-height: 200px; overflow-y: auto;">
                                @forelse($searchTambahResults as $santri)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $santri->nama }}</strong>
                                            <small class="text-muted">
                                                ({{ $santri->kelas?->nama ?? 'Tanpa Kelas' }})
                                            </small>
                                        </div>
                                        <button
                                            wire:click.prevent="selectSantri('{{ $santri->id }}', '{{ $santri->nama }}')"
                                            class="btn btn-sm btn-success">Pilih</button>
                                    </li>
                                @empty
                                    @if ($searchSantri || $filterTambah['jenjang'] || $filterTambah['kelas'])
                                        <li class="list-group-item text-center">Tidak ada santri ditemukan</li>
                                    @endif
                                @endforelse
                            </ul>

                            <!-- Santri Terpilih -->
                            @if ($selectedSantri)
                                <div class="mt-3 p-3 border rounded" style="max-height: 200px; overflow-y: auto;">
                                    <h6 class="fw-bold">Santri Terpilih:</h6>
                                    @if ($selectedSantri->foto)
                                        <img {{ Storage::url('images/santri/' . basename($selectedSantri->foto)) }}
                                            class="card-img-top"
                                            style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                    @else
                                        <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}"
                                            class="img-fluid mx-auto"
                                            style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                    @endif
                                    <p class="mb-1">Nama: {{ $selectedSantri->nama }}</p>
                                    <p class="mb-1">Kelas: {{ $selectedSantri->kelas?->nama ?? 'Belum ada kelas' }}
                                    </p>
                                    <p class="mb-1">Kamar: {{ $selectedSantri->kamar?->nama ?? 'Belum ada kamar' }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click="resetForm">Tutup</button>
                        <button wire:click="createStore" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.class.remove="d-none"
                                class="d-none spinner-border spinner-border-sm"></span>
                            Simpan SPP
                        </button>
                    </div>
                </div>
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
                const dropdown = document.querySelectorAll('.dropdown-menu');
                if (dropdown) {
                    dropdown.classList.remove('show');
                }
            }
        });
    });
</script>
