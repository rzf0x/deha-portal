<div>
    <!-- Search Form -->
    <div class="form-group sticky-top bg-white p-3 shadow-sm cursor-pointer" style="top: 1rem; z-index: 99;">
        <form wire:submit.prevent="searchSantri" class="d-flex gap-3">
            <input type="text" wire:keydown.debounce.50ms="searchSantri"  wire:model="search" class="form-control" placeholder="Cari Santri..." required>
            <button type="submit" class="btn btn-primary w-25">Cari</button>
        </form>
    </div>

    <!-- Error Message -->
    @if ($errorMessage)
        <div class="alert alert-danger mt-3">{{ $errorMessage }}</div>
    @endif

    <!-- Search Results -->
    <div class="d-flex flex-wrap mt-3">
        @foreach ($searchResults as $santri)
            <div wire:click="selectSantri({{ $santri->id }})" class="mx-2 card w-25" style="cursor: pointer;">
                <img src="{{ $santri->foto }}" class="card-img-top" alt="">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $santri->nama }}</h5>
                    <p class="card-text">TTL: {{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir }}</p>
                    <p class="card-text">Kelas: {{ $santri->kelas->nama }}</p>
                    <p class="card-text">Jenjang: {{ $santri->kelas->jenjang->nama }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Santri Biodata and Payment Timeline -->
    @if ($santriSelected && $santriSelected->id)
        <div class="row mt-4">
            <div class="col-12">
                <!-- Biodata Santri -->
                <div class="card p-4 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Biodata Santri</h3>
                    </div>
                    <div class="row card-body">
                        @foreach ([
                            'Nama Santri' => $santriSelected->nama,
                            'TTL' => "{$santriSelected->tempat_lahir}, {$santriSelected->tanggal_lahir}",
                            'Kelas' => $santriSelected->kelas->nama,
                            'Kamar' => $santriSelected->kamar->nama,
                            'Jenjang' => $santriSelected->kelas->jenjang->nama,
                        ] as $label => $value)
                            <div class="col-lg-6">
                                <h6>{{ $label }}:</h6>
                                <p>{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pembayaran Timeline -->
                <div class="card p-4">
                    <div class="card-title">
                        <h3 class="mt-3">Timeline Pembayaran</h3>
                    </div>
                    <div class="d-flex flex-wrap">
                        @foreach ($pembayaran as $item)
                            <button wire:loading.attr="disabled" wire:click="selectPembayaran({{ $item->id }})" class="mx-1 my-1 btn 
                                @if ($item->status === 'lunas') btn-success 
                                @elseif ($item->status === 'belum bayar') btn-danger 
                                @else btn-warning @endif">
                                {{ $item->pembayaranTimeline->nama_bulan }}
                            </button>
                        @endforeach
                    </div>
                    <hr>
                    <div class="mt-1">
                        <p style="margin-bottom: -5px;">Keterangan:</p>
                        <div class="d-flex flex-row">
                            <span class="mr-3"><span class="text-danger">Merah</span>: <strong>Belum bayar</strong></span>
                            <span class="mr-3"><span class="text-success">Hijau</span>: <strong>Lunas</strong></span>
                            <span class="mr-3"><span class="text-warning">Kuning</span>: <strong>Cicilan</strong></span>
                        </div>
                    </div>

                    <!-- Modal Pembayaran -->
                    @if ($isModalOpen)
                        <div class="card mt-3">
                            <div class="row">
                                <div class="col-12 @if ($selectedStatus === 'cicilan') col-lg-6 @endif d-flex flex-column">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h 6>Detail Pembayaran: bulan <span class="text-primary">{{ $Clickpembayaran->pembayaranTimeline->nama_bulan }}</span></h6>
                                        <div wire:click="closeModal">
                                            <a class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body form-group">
                                        <label for="status">Ubah status pembayaran: 
                                            <span wire:target='selectedStatus' wire:loading.class.remove='d-none' class="d-none spinner-border spinner-border-sm"></span>
                                        </label>
                                        <select wire:model.live="selectedStatus" class="form-control">
                                            <option value="lunas">Lunas</option>
                                            <option value="belum bayar">Belum Bayar</option>
                                            <option value="cicilan">Cicilan</option>
                                        </select>
                                    </div>
                                    @if ($selectedStatus != 'belum bayar')
                                    <div class="card-body form-group">
                                        <label for="Metode">Ubah Metode pembayaran:
                                            <span wire:target='selectedMetodePembayaran' wire:loading.class.remove='d-none' class="d-none spinner-border spinner-border-sm"></span>
                                        </label>
                                        <select wire:model.live="selectedMetodePembayaran" class="form-control">
                                            <option value="transfer">Transfer</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </div>
                                    @endif
                                    <div class="d-flex justify-content-end mb-3 mr-3">
                                        <button wire:loading.attr="disabled" wire:click="updatePembayaran" class="btn btn-primary">Update Data</button>
                                    </div>
                                </div>
                                @if ($selectedStatus === 'cicilan')
                                    <div class="col-12 col-lg-6 d-flex flex-column">
                                        <div class="card-title">
                                            <h5>Rincian Cicilan</h5>
                                        </div>
                                        <div class="card-body">
                                            <form wire:submit.prevent="storeCicilan" method="post">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control" wire:model="keteranganCicilan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input type="number" class="form-control" wire:model="jumlahCicilan" required>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button wire:loading.attr="disabled" class="btn btn-primary" wire:click='$refresh'>Simpan</button>
                                                </div>
                                            </form>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- End of Modal Pembayaran -->

                </div>
                <!-- Pilih Metode Pembayaran -->
                <div class="card p-4">
                    <div class="card-title">
                        <h3 class="mt-3">Pilih Metode Pembayaran:</h3>
                    </div>
                    @foreach ($detailPembayaran as $item)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="method-{{ $item->id }}" wire:model.live="selectedMethods" value="{{ $item->id }}">
                            <label class="form-check-label" for="method-{{ $item->id }}">{{ $item->nama }} - {{ number_format($item->nominal, 0, ',', '.') }}</label>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Total Pembayaran:</strong></p>
                        <p class="pr-4">{{ number_format($totalAmount, 0, ',', '.') }}</p>
                    </div>
                    <button wire:loading.attr="disabled" class="btn btn-primary" wire:click="calculateTotalAmount">Kalkulasi Nilai</button>
                </div>
            </div>
        </div>
    @endif
</div>