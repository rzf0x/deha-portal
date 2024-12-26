<div>

    {{-- cari santri --}}
    <div class="form-group bg-white p-3 shadow-sm" style="z-index: 99;">
        @if (!($santriSelected && $santriSelected?->id))
            <form wire:submit.prevent="searchSantri" class="d-flex gap-3">
                <input type="text" wire:model="search" class="form-control" placeholder="Cari Santri...">

                <div class="d-flex gap-3 w-50">
                    <select wire:change='searchSantri' wire:model='filter.jenjang' class="form-select" name=""
                        id="" wire:loading.attr='disabled'>

                        <option value="">Pilih Jenjang</option>

                        @foreach ($jenjangOptions as $jenjang)
                            <option value="{{ $jenjang->nama }}">{{ $jenjang->nama }}</option>
                        @endforeach
                    </select>

                    <select wire:change='searchSantri' wire:model='filter.kelas' class="form-select" name=""
                        id="" wire:loading.attr='disabled'>
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelasOptions as $kelas)
                            <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-25">Cari</button>
            </form>
        @else
            <button wire:click='kembaliButton' class="btn btn-primary">kembali</button>
        @endif
    </div>
    <div class="sticky-top" style="top:1rem;z-index: 99;">
        @if ($errorMessage)
            <div class="alert alert-danger mt-3 errorMessage">{{ $errorMessage }}</div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger mt-3 errorMessage">
                    <p>Error, {{ $error }}</p>
                </div>
            @endforeach
        @endif

        @if ($message)
            <div class="alert alert-success mt-3 message">{{ $message }}</div>
        @endif
    </div>
    {{-- #end cari santri --}}

    {{-- result cari santri --}}
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
    {{-- #end result cari santri --}}

    {{-- biodata santri & pembayaran & metode pembayaran --}}
    @if ($santriSelected && $santriSelected?->id)
        <div class="row mt-4">
            <div class="col-12">

                <!-- biodata santri -->
                <div class="card p-4 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Biodata Santri</h3>
                    </div>
                    <div class="row card-body">
                        <div class="col-lg-6">
                            <h6>Nama Santri:</h6>
                            <p>{{ $santriSelected->nama }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>TTL:</h6>
                            <p>{{ $santriSelected->tempat_lahir }}, {{ $santriSelected->tanggal_lahir }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Kelas:</h6>
                            <p>{{ $santriSelected->kelas->nama }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Kamar:</h6>
                            <p>{{ $santriSelected->kamar->nama }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Jenjang:</h6>
                            <p>{{ $santriSelected->kelas->jenjang->nama }}</p>
                        </div>
                    </div>
                </div>
                <!-- #end biodata santri -->

                <!-- pembayaran timeline -->
                <div class="card p-4">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h3 class="mt-3">Timeline Pembayaran</h3>
                        <div class="">
                            <select wire:loading.attr='disabled' wire:model.live="filter.tahunAjaran" wire:change='generateDataPembayaranSantri' class="form-select">
                                @foreach ($tahunAjaranOptions as $tahun)
                                    <option value="{{ $tahun->nama_tahun }}">{{ $tahun->nama_tahun }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
                        @forelse ($pembayaranList as $item)
                            <button wire:loading.attr="disabled" wire:click="selectPembayaran({{ $item->id }})"
                                class="mx-1 my-1 btn 
                                @if ($item->status === 'lunas') btn-success 
                                @elseif ($item->status === 'belum bayar') btn-danger 
                                @else btn-warning @endif">
                                {{ $bulanTimeline[$item->id] }}
                            </button>
                            @empty
                            <button wire:loading.attr="disabled" wire:click="createPembayaranTImeline" class="btn btn-primary">
                                generate timeline tahun {{ $filter['tahunAjaran'] }}
                            </button>
                        @endforelse
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
                                                style="font-weight: 900">{{ $pembayaranSelected->pembayaranTimeline->nama_bulan }}</span>
                                        </h5>
                                    </div>

                                    @if ($selectedStatus === 'cicilan')
                                        <div class="col-12 col-lg-6 d-flex justify-content-between">
                                            <h5>Rincian Cicilan</h5>
                                            <a href="{{ route('spp.detail-laporan-cicilan-santri', [
                                                'id' => $santriSelected->id,
                                                'bulan' => $pembayaranSelected->pembayaranTimeline->nama_bulan,
                                            ]) }}"
                                                class="text-decoration-underline {{ $pembayaranSelected->cicilans->isNotEmpty() ? '' : 'd-none' }}">Lihat
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
                                            <div class="mb-2">
                                                <label for="status">Ubah status pembayaran:
                                                    <span wire:target='selectedStatus'
                                                        wire:loading.class.remove='d-none'
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
                                                {{-- metode pembayaran --}}
                                                <div class="mb-2">
                                                    <label for="Metode">Ubah Metode pembayaran:
                                                        <span wire:target='selectedMetodePembayaran'
                                                            wire:loading.class.remove='d-none'
                                                            class="d-none spinner-border spinner-border-sm"></span>
                                                    </label>
                                                    <select wire:loading.attr="disabled"
                                                        wire:model.live="selectedMetodePembayaran"
                                                        class="form-control">
                                                        <option value="transfer">Transfer</option>
                                                        <option value="cash">Cash</option>
                                                    </select>
                                                </div>

                                                @if ($selectedStatus !== 'cicilan')
                                                    <div class="mb-2">
                                                        <label for="Metode">Masukan Bukti Pembayaran
                                                            <span
                                                                wire:target='buktiPembayaran,updatePembayaran,storeCicilan'
                                                                wire:loading.class.remove='d-none'
                                                                class="d-none spinner-border spinner-border-sm"></span>
                                                        </label>
                                                        <input required type="file" class="form-control"
                                                            wire:loading.attr='disabled' wire:model="buktiPembayaran">
                                                    </div>

                                                    @if ($buktiPembayaran)
                                                        @if ($buktiPembayaran instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                                            <div class="rounded-4 w-100">
                                                                <img src="{{ $buktiPembayaran?->temporaryUrl() }}"
                                                                    alt="Foto" class="rounded-4 object-fit-cover"
                                                                    style="height: 15rem;">
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </div>

                                        {{-- tampilkan button update status pembayaran --}}
                                        @if ($selectedStatus !== 'cicilan')
                                            <div class="d-flex justify-content-end mt-3">
                                                <div class="d-flex justify-content-end">
                                                    <button
                                                        @if ($buktiPembayaran) @if (!($buktiPembayaran instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)) 
                                                        disabled @endif
                                                        @endif
                                                        wire:loading.attr="disabled"
                                                        wire:target='buktiPembayaran,updatePembayaran,storeCicilan'
                                                        wire:click="updatePembayaran" class="btn btn-primary">
                                                        @if ($buktiPembayaran)
                                                            @if (!($buktiPembayaran instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile))
                                                                tunggu sebentar
                                                            @else
                                                                Update status pembayaran
                                                            @endif
                                                        @else
                                                            status pembayaran
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- detail cicilan -->
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
                                                        <span
                                                            wire:target='buktiPembayaran,updatePembayaran,storeCicilan'
                                                            wire:loading.class.remove='d-none'
                                                            class="d-none spinner-border spinner-border-sm"></span>
                                                    </label>
                                                    <input required type="file" class="form-control"
                                                        wire:loading.attr='disabled' wire:model="buktiPembayaran">
                                                </div>
                                                @if ($buktiPembayaran)
                                                    @if ($buktiPembayaran instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                                        <div class="rounded-4 w-100">
                                                            <img src="{{ $buktiPembayaran?->temporaryUrl() }}"
                                                                alt="Foto" class="rounded-4 object-fit-cover"
                                                                style="height: 15rem;">
                                                        </div>
                                                    @endif
                                                @endif
                                                <div class="d-flex justify-content-end">
                                                    <button
                                                        @if ($buktiPembayaran) @if (!($buktiPembayaran instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)) 
                                                        disabled @endif
                                                        @endif
                                                        type="submit" wire:loading.attr="disabled"
                                                        wire:target='buktiPembayaran,updatePembayaran,storeCicilan'
                                                        class="btn btn-primary">
                                                        @if ($buktiPembayaran)
                                                            @if (!($buktiPembayaran instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile))
                                                                tunggu sebentar
                                                            @else
                                                                Tambahkan Cicilan
                                                            @endif
                                                        @else
                                                            tambahkan cicilan
                                                        @endif
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
                    <!-- #End of Modal Pembayaran -->

                </div>
                <!-- #end pembayaran timeline -->

                <!-- pilih metode pembayaran -->
                <div class="card p-4">
                    <div class="card-title">
                        <h3 class="mt-3">Lihat Metode Pembayaran:</h3>
                    </div>
                    @foreach ($listDetailPembayaran as $item)
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
                        <p class="pr-4">{{ number_format($totalPembayaran, 0, ',', '.') }}</p>
                    </div>
                    <button wire:loading.attr="disabled" class="btn btn-primary"
                        wire:click="calculateTotalPembayaran">Kalkulasi Nilai</button>
                </div>
                <!-- #end pilih metode pembayaran -->

            </div>
        </div>
    @endif
    {{-- #end santri & pembayaran & timeline --}}

</div>

<script>
    window.addEventListener('hide-error', event => {
        setTimeout(() => {
            @this.set('errorMessage', '');
            @this.call('clearErrors');
        }, 1000);
    });
    window.addEventListener('hide-message', event => {
        setTimeout(() => {
            @this.set('message', '');
        }, 1000);
    });
</script>
