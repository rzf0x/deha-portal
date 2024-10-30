<div>
    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)"
                class="alert alert-success w-25">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Combined Filters, Create Button, and Table -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex gap-3">
                    <!-- Filters Section -->
                    <div>
                        <label for="jenjangFilter" class="form-label">Filter Jenjang</label>
                        <select id="jenjangFilter" wire:model.live="jenjangFilter" class="form-select">
                            <option value="">Semua Jenjang</option>
                            @foreach ($this->getAllJenjang() as $jenjang)
                                <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tipePembayaranFilter" class="form-label">Filter Tipe Pembayaran</label>
                        <select id="tipePembayaranFilter" wire:model.live="tipePembayaranFilter" class="form-select">
                            <option value="">Semua Tipe</option>
                            @foreach ($tipePembayaranOptions as $id => $nama)
                                <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Create Button -->
                <button wire:click="create()" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#default">
                    <i class="bi bi-plus-circle"></i>
                    <span class="ms-1">Tambah Data</span>
                </button>
            </div>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Jenjang</th>
                            <th>Tipe Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getFilteredData as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        Rp. {{ number_format($item->nominal, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $item->jenjang->nama ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->pembayaranTipe->nama }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal"
                                            data-bs-target="#default" class="btn btn-sm btn-warning">Edit</button>
                                        <button wire:confirm="Yakin ingin menghapus data {{ $item->id }}"
                                            wire:click="delete({{ $item->id }})"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data yang ditampilkan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header {{ $itemPembayaranId ? 'bg-warning' : 'bg-primary' }}">
                    <h5 class="modal-title {{ $itemPembayaranId ? 'text-dark' : 'text-white' }}">
                        {{ $itemPembayaranId ? 'Edit Item Pembayaran' : 'Tambah Item Pembayaran' }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" wire:model="ItemPembayaranForm.nama" required
                                    id="nama" placeholder="Enter Nama">
                                @error('ItemPembayaranForm.nama')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" wire:model="ItemPembayaranForm.nominal" required
                                    id="nominal" placeholder="Enter Nominal">
                                @error('ItemPembayaranForm.nominal')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="">
                                <label for="pembayaran_tipe">Tipe Pembayaran</label>
                                <select class="form-control" wire:model="ItemPembayaranForm.pembayaran_tipe_id">
                                    <option value="">-- Pilih Tipe Pembayaran --</option>
                                    @foreach ($tipePembayaranOptions as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                                @error('ItemPembayaranForm.pembayaran_tipe_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="">
                                <label for="jenjang">Jenjang</label>
                                <select class="form-control" wire:model="ItemPembayaranForm.jenjang_id">
                                    <option value="">-- Pilih Jenjang --</option>
                                    @foreach ($this->getAllJenjang() as $jenjang)
                                        <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                                    @endforeach
                                </select>
                                @error('ItemPembayaranForm.jenjang_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="store()">Save</button>
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
</div>
