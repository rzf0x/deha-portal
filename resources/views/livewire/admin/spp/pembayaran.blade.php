<div>
    <!-- Search Form -->
    <div class="form-group sticky-top bg-white p-3 shadow-sm cursor-pointer" style="top: 1rem; z-index: 99;">
        <form wire:submit.prevent="searchSantri" class="d-flex gap-3">
            <input type="text" wire:model="search" class="form-control" placeholder="Cari Santri...">
            <div class="d-flex gap-3 w-50">
                <select wire:change='searchSantri' wire:model='filter.jenjang' class="form-select" name=""
                    id="" wire:loading.attr='disabled'>
                    <option value="">Pilih Jenjang</option>
                    @forelse ($jenjangs as $jenjang)
                        <option value="{{ $jenjang->nama }}">{{ $jenjang->nama }}</option>
                    @empty
                    @endforelse
                </select>
                <select wire:change='searchSantri' wire:model='filter.kelas' class="form-select" name=""
                    id="" wire:loading.attr='disabled'>
                    <option value="">Pilih Kelas</option>
                    @forelse ($kelas as $kelas)
                        <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-25">Cari</button>
        </form>
        @if ($errorMessage)
            <div class="alert alert-danger mt-3 errorMessage">{{ $errorMessage }}</div>
        @endif
        @if ($message)
            <div class="alert alert-success mt-3 message">{{ $message }}</div>
        @endif
    </div>

    <!-- Error Message -->

    <!-- Search Results -->
    @if (!($santriSelected && $santriSelected?->id))
        <div class="row mt-3">
            @foreach ($searchResults as $santri)
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
                    <div wire:click="selectSantri({{ $santri->id }})" class="card py-4" style="cursor: pointer;">
                        @if ($santri->foto)
                            <img {{ Storage::url('images/santri/' . basename($santri?->foto)) }} class="card-img-top"
                                style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        @else
                            <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}" class="img-fluid mx-auto"
                                style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $santri->nama }}</h5>
                            <p class="card-text">TTL: {{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir }}</p>
                            <p class="card-text">Kelas: {{ $santri->kelas->nama }}</p>
                            <p class="card-text">Jenjang: {{ $santri->kelas->jenjang->nama }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Santri Biodata and Payment Timeline -->
    @if ($santriSelected && $santriSelected?->id)
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
                            <button wire:loading.attr="disabled" wire:click="selectPembayaran({{ $item->id }})"
                                class="mx-1 my-1 btn 
                                @if ($item->status === 'lunas') btn-success 
                                @elseif ($item->status === 'belum bayar') btn-danger 
                                @else btn-warning @endif">
                                {{ $bulanTimeline[$item->id] }}
                            </button>
                        @endforeach
                    </div>
                    <hr>

                    <div class="mt-1">
                        <p style="margin-bottom: 0;">Keterangan:</p>
                        <div class="d-flex flex-row gap-3">
                            <span class="mr-3"><span class="text-danger">Merah </span>: <span class="fw-bold">Belum
                                    bayar</span></span>
                            <span class="mr-3"><span class="text-success">Hijau </span>: <span
                                    class="fw-bold">Lunas</span></span>
                            <span class="mr-3"><span class="text-warning">Kuning </span>: <span
                                    class="fw-bold">Cicilan</span></span>
                        </div>
                    </div>

                    <!-- Modal Pembayaran -->
                    @if ($isModalOpen)
                        <div class="card mt-3">
                            <div class="card-body">
                                <!-- Row for aligning headers -->
                                <div class="row mb-3">
                                    <div class="col-12 @if ($selectedStatus === 'cicilan') col-lg-6 @endif">
                                        <h5>Detail Pembayaran: bulan
                                            <span class="text-primary"
                                                style="font-weight: 900">{{ $Clickpembayaran->pembayaranTimeline->nama_bulan }}</span>
                                        </h5>
                                    </div>

                                    @if ($selectedStatus === 'cicilan')
                                        <div class="col-12 col-lg-6 d-flex justify-content-between">
                                            <h5>Rincian Cicilan</h5>
                                            <a href="{{ route('spp.detail-laporan-cicilan-santri', [
                                                'id' => $santriSelected->id,
                                                'bulan' => $Clickpembayaran->pembayaranTimeline->nama_bulan,
                                            ]) }}"
                                                class="text-decoration-underline {{ $Clickpembayaran->cicilans->isNotEmpty() ? '' : 'd-none' }}">Lihat
                                                Detail Cicilan</a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Row for main content sections -->
                                <div class="row">
                                    <!-- Payment Details Section -->
                                    <div
                                        class="col-12 @if ($selectedStatus === 'cicilan') col-lg-6 @endif d-flex flex-column">
                                        <div class="form-group">
                                            <label for="status">Ubah status pembayaran:
                                                <span wire:target='selectedStatus' wire:loading.class.remove='d-none'
                                                    class="d-none spinner-border spinner-border-sm"></span>
                                            </label>
                                            <select wire:loading.attr="disabled" wire:model.live="selectedStatus"
                                                class="form-control">
                                                <option value="lunas">Lunas</option>
                                                <option value="belum bayar">Belum Bayar</option>
                                                <option value="cicilan">Cicilan</option>
                                            </select>
                                        </div>

                                        @if ($selectedStatus != 'belum bayar')
                                            <div class="form-group">
                                                <label for="Metode">Ubah Metode pembayaran:
                                                    <span wire:target='selectedMetodePembayaran'
                                                        wire:loading.class.remove='d-none'
                                                        class="d-none spinner-border spinner-border-sm"></span>
                                                </label>
                                                <select wire:loading.attr="disabled"
                                                    wire:model.live="selectedMetodePembayaran" class="form-control">
                                                    <option value="transfer">Transfer</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                                @if ($selectedStatus !== 'cicilan')
                                                    <div class="form-group">
                                                        <label for="Metode">Masukan Bukti Pembayaran
                                                            <span wire:target='buktiPembayaran'
                                                                wire:loading.class.remove='d-none'
                                                                class="d-none spinner-border spinner-border-sm"></span>
                                                        </label>
                                                        <input required type="file" class="form-control"
                                                            wire:loading.attr='disabled'
                                                            wire:model.live.debounce.1ms="buktiPembayaran">
                                                    </div>

                                                    @if ($buktiPembayaran)
                                                        <div class="rounded-4 w-100">
                                                            <img src="{{ $buktiPembayaran?->temporaryUrl() }}"
                                                                alt="Foto" class="rounded-4 object-fit-cover"
                                                                style="height: 15rem;">
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endif
                                        @if ($selectedStatus !== 'cicilan')
                                            <div class="d-flex justify-content-end mt-3">
                                                <div class="d-flex justify-content-end">
                                                    <button wire:loading.attr="disabled" wire:target='buktiPembayaran'
                                                        wire:click="updatePembayaran" class="btn btn-primary">Update
                                                        status pembayaran</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Installment Details Section -->
                                    @if ($selectedStatus === 'cicilan')
                                        <div class="col-12 col-lg-6 d-flex flex-column">
                                            <form wire:submit.prevent="storeCicilan" method="post">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="keteranganCicilan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input type="number" class="form-control"
                                                        wire:model="jumlahCicilan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Metode">Masukan Bukti Pembayaran
                                                        <span wire:target='buktiPembayaran'
                                                            wire:loading.class.remove='d-none'
                                                            class="d-none spinner-border spinner-border-sm"></span>
                                                    </label>
                                                    <input required type="file" class="form-control"
                                                        wire:loading.attr='disabled'
                                                        wire:model.live.debounce.1ms="buktiPembayaran">
                                                </div>
                                                @if ($buktiPembayaran)
                                                    <div class="rounded-4 w-100">
                                                        <img src="{{ $buktiPembayaran?->temporaryUrl() }}"
                                                            alt="Foto" class="rounded-4 object-fit-cover"
                                                            style="height: 15rem;">
                                                    </div>
                                                @endif
                                                <div class="d-flex justify-content-end">
                                                    <button wire:loading.attr="disabled" wire:loading.class="d-none"
                                                        wire:target='buktiPembayaran' class="btn btn-primary"
                                                        wire:click='$refresh'>
                                                        Tambahkan Cicilan
                                                    </button>
                                                </div>
                                            </form>

                                            @if ($errors->any())
                                                <div class="alert alert-danger mt-3">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
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
                            <input type="checkbox" class="form-check-input" id="method-{{ $item->id }}"
                                wire:model.live="selectedMethods" value="{{ $item->id }}">
                            <label class="form-check-label" for="method-{{ $item->id }}">{{ $item->nama }} -
                                {{ number_format($item->nominal, 0, ',', '.') }}</label>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Total Pembayaran:</strong></p>
                        <p class="pr-4">{{ number_format($totalAmount, 0, ',', '.') }}</p>
                    </div>
                    <button wire:loading.attr="disabled" class="btn btn-primary"
                        wire:click="calculateTotalAmount">Kalkulasi Nilai</button>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    window.addEventListener('hide-error', event => {
        setTimeout(() => {
            @this.set('errorMessage', '');
        }, 2000);
    });
    window.addEventListener('hide-message', event => {
        setTimeout(() => {
            @this.set('message', '');
        }, 2000);
    });
</script>
