<div>
    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-success w-25">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Santri</h5>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="150">Nama</td>
                            <td>: {{ $santri->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: <span class="badge bg-info">{{ $santri->kelas?->nama ?? 'Belum ada kelas' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kamar</td>
                            <td>: <span
                                    class="badge bg-warning text-dark">{{ $santri->kamar?->nama ?? 'Belum ada kamar' }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Pembayaran</h6>
                                    <h3 class="text-white">{{ number_format($total_pembayaran) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Nominal</h6>
                                    <h3 class="text-white">Rp {{ number_format($total_nominal) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title">Riwayat Pembayaran</h5>
                <div class="d-flex gap-2">
                    <select wire:model.live="filter.tahun" class="form-select">
                        @foreach ($tahunList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="filter.status" class="form-select">
                        <option value="">Pilih Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="belum bayar">belum bayar</option>
                        <option value="cicilan">cicilan</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Bulan</th>
                            <th>Nominal</th>
                            <th>Tipe</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Bukti</th>
                            <th>cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembayaran as $bayar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bayar->created_at->format('d/m/Y') }}</td>
                                <td>{{ $bayar->pembayaranTimeline->nama_bulan }}</td>
                                <td>Rp {{ number_format($bayar->nominal) }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ str($bayar->pembayaranTipe->nama) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ str($bayar->metode_pembayaran)->title() }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ match ($bayar->status) {
                                            'lunas' => 'bg-success',
                                            'cicilan' => 'bg-warning text-dark',
                                            default => 'bg-danger',
                                        } }}">
                                        {{ str($bayar->status)->title() }}
                                    </span>
                                </td>
                                <td>
                                    {{-- @dd($bayar) --}}
                                    @if ($bayar->status == 'cicilan')
                                        <a href="{{ route('spp.detail-laporan-cicilan-santri', [
                                            'id' => $santri->id,
                                            'bulan' => $bayar->pembayaranTimeline->nama_bulan,
                                        ]) }}"
                                            class="text-decoration-underline">Lihat Detail Cicilan</a>
                                    @elseif($bayar->status == 'lunas')
                                        @if ($bayar->bukti_pembayaran)
                                            <a href="{{ url('storage/' . $bayar->bukti_pembayaran) }}" target="_blank"
                                                class="badge bg-success">Lihat Bukti Pembayaran</a>
                                        @else
                                            <span class="badge bg-danger">
                                                kosong
                                            </span>
                                        @endif
                                    @elseif($bayar->status == 'belum bayar')
                                        <span class="badge bg-danger">
                                            kosong
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($bayar->status !== 'belum bayar')
                                        <a href='{{ route('cetak-kwitansi-spp', ['id' => $bayar->id]) }}'
                                            class="btn btn-primary">
                                            Cetak Kwitansi
                                        </a>
                                    @else
                                        <span class="badge bg-danger">Santri belum bayar</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data pembayaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
