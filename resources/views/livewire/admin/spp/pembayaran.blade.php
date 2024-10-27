<div>
    <!-- Search Form -->
    <div class="form-group" style="position:sticky; top:1rem; z-index:99;">
        <form wire:submit.prevent="searchSantri" class="d-flex gap-3">
            <input type="text" wire:model="search" class="form-control" placeholder="Cari Santri...">
            <button type="submit" class="btn btn-primary ml-4 w-25">Cari</button>
        </form>
    </div>

    <!-- Error Message -->
    @if ($errorMessage)
        <div class="alert alert-danger">
            {{ $errorMessage }}
        </div>
    @endif

    <!-- Search Results -->
    <div class="d-flex">
        @foreach ($searchResults as $santri)
            <div wire:click="selectSantri({{ $santri->id }})" class="mx-2 card w-25" role="button">
                <div class="card-body text-center">
                    <span class="d-block mb-3">
                        <img src="{{ $santri->foto }}" class="w-50" alt="">
                    </span>
                    <span class="my-2 d-block">Nama: {{ $santri->nama }}</span>
                    <span class="my-2 d-block">TTL: {{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir }}</span>
                    <span class="my-2 d-block">Kelas: {{ $santri->kelas->nama }}</span>
                    <span class="my-2 d-block">Jenjang: {{ $santri->kelas->jenjang->nama }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Santri Biodata and Payment Timeline -->
    @if ($santriSelected && $santriSelected->id)
        <div class="row">
            <div class="col-12">

                <!-- Biodata Santri -->
                <div class="card p-4">
                    <div class="card-header">
                        <h3 class="card-title">Biodata Santri</h3>
                    </div>
                    <div class="row card-body">
                        <div class="col-lg-6">
                            <h6>Nama Santri :</h6>
                            <p>{{ $santriSelected->nama }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>TTL :</h6>
                            <p>{{ $santriSelected->tempat_lahir }}, {{ $santriSelected->tanggal_lahir }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Kelas</h6>
                            <p>{{ $santriSelected->kelas->nama }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Kamar :</h6>
                            <p>{{ $santriSelected->kamar->nama }}</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Jenjang :</h6>
                            <p>{{ $santriSelected->kelas->jenjang->nama }}</p>
                        </div>
                    </div>
                </div>
                <!-- End of Biodata Santri -->

                <!-- Pembayaran Timeline -->
                <div class="card p-4">
                    <div>
                        <div class="card-title">
                            <h3 class="mt-3">Timeline Pembayaran</h3>
                        </div>
                        @foreach ($pembayaran as $item)
                            <button wire:click="selectPembayaran({{ $item->id }})"
                                class="mx-1 my-1 btn
                                @if ($item->status === 'lunas') btn-success
                                @elseif ($item->status === 'belum bayar') btn-danger
                                @else btn-warning @endif">
                                {{ $item->pembayaranTimeline->nama_bulan }}
                            </button>
                        @endforeach
                    </div>
                    <hr>
                    <div class="flex mt-1">
                        <p style="margin-bottom: -5px;">Keterangan :</p>
                        <div class="flex flex-row">
                            <span class="mr-3">
                                <span class="text-danger">Merah</span> :
                                <span style="font-weight: bold">Belum bayar</span>
                            </span>
                            <span class="mr-3">
                                <span class="text-success">Hijau</span> :
                                <span style="font-weight: bold">Lunas</span>
                            </span>
                            <span class="mr-3">
                                <span class="text-warning">Kuning</span> :
                                <span style="font-weight: bold">Cicilan</span>
                            </span>
                        </div>
                    </div>

                    <!-- Modal Pembayaran -->
                    @if ($isModalOpen)
                        <div class="card mt-3">
                            <div class="row">
                                <div
                                    class="@if ($selectedStatus == 'cicilan') ) col-12 col-lg-6 @else col-12 @endif d-flex flex-column">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6>Detail Pembayaran: bulan <span
                                                class="text-primary">{{ $Clickpembayaran->pembayaranTimeline->nama_bulan }}</span>
                                        </h6>
                                        <div wire:click="closeModal">
                                            <a class="btn btn-icon btn-danger" href="#"><i
                                                    class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body form-group">
                                        <label for="status">Ubah status pembayaran:</label>
                                        <select wire:model="selectedStatus" class="form-control">
                                            <option value="lunas">Lunas</option>
                                            <option value="belum bayar">Belum Bayar</option>
                                            <option value="cicilan">Cicilan</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end mb-3 mr-3">
                                        <button wire:click="updatePembayaran"class="btn btn-primary">Update
                                            Data</button>
                                    </div>
                                </div>
                                @if ($selectedStatus == 'cicilan')
                                    <div class="col-12 col-lg-6 d-flex flex-column">
                                        <div class="card-title">
                                            <h5>Rincian Cicilan</h5>
                                        </div>
                                        <div class="card-body">
                                            <form wire:submit.prevent="storeCicilan" method="post">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="keteranganCicilan">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input type="number" class="form-control"
                                                        wire:model="jumlahCicilan">
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary"
                                                        wire:click='$refresh'>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif







                    <!-- End of Modal Pembayaran -->

                </div>

                <div class="card p-4">
                    <div class="card-title">
                        <h3 class="mt-3">Pilih Metode Pembayaran:</h3>
                    </div>
                    @foreach ($detailPembayaran as $item)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="method-{{ $item->id }}"
                                wire:model="selectedMethods" value="{{ $item->id }}">
                            <label class="form-check-label" for="method-{{ $item->id }}">
                                {{ $item->nama }} - {{ number_format($item->nominal, 0, ',', '.') }}
                            </label>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Total Pembayaran:</strong></p>
                        <p class="pr-4">{{ number_format($totalAmount, 0, ',', '.') }}</p>
                    </div>
                    <button class="btn btn-primary" wire:click="calculateTotalAmount">
                        Kalkulasi Nilai
                    </button>
                </div>
                <!-- End of Pembayaran Timeline -->
            </div>
        </div>
    @endif
</div>
