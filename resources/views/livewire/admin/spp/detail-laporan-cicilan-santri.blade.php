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
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $total_cicilan_belum_bayar < 0 ? 'Cicilan Lunas Lebih' : 'Total belum lunas' }} </h6>
                                    <h4 class="text-white">
                                        {{number_format($total_cicilan_belum_bayar < 0 ? -$total_cicilan_belum_bayar : $total_cicilan_belum_bayar ) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Cicilan</h6>
                                    <h4 class="text-white">{{ number_format($total_cicilan) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Nominal</h6>
                                    <h4 class="text-white">Rp {{ number_format($total_nominal) }}</h4>
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
                <h5 class="card-title">Riwayat Cicilan</h5>
                <div class="d-flex gap-2">
                    <select wire:model.live="filter.tahun" wire:change='generateData' class="form-select">
                        @foreach ($tahunList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="filter.bulan" wire:change='generateData' class="form-select">
                        <option value="">Pilih Bulan</option>
                        @foreach ($bulanList as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Bulan</th>
                            <th>Tipe</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Bukti Pembayaran</th>
                            <th>Kwitansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cicilan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($item->nominal) }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->pembayaran->pembayaranTimeline->nama_bulan }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ str($item->pembayaran->pembayaranTipe->nama) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ str($item->pembayaran->metode_pembayaran)->title() }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ match ($item->pembayaran->status) {
                                            'lunas' => 'bg-success',
                                            'cicilan' => 'bg-warning text-dark',
                                            default => 'bg-danger',
                                        } }}">
                                        {{ str($item->pembayaran->status)->title() }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->bukti_pembayaran)
                                        <a href="{{ url('storage/' . $item->pembayaran->bukti_pembayaran) }}"
                                            target="_blank" class="badge bg-success">Lihat Bukti Pembayaran</a>
                                    @else
                                        <span class="badge bg-danger">
                                            kosong
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status !== 'belum bayar')
                                        <a href='{{ route('cetak-kwitansi-cicilan-spp', ['id' => $item->id]) }}'
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
                                <td colspan="10" class="text-center">
                                    @if ($filter['bulan'])
                                        Tidak ada data cicilan pada bulan {{ $filter['bulan'] }}
                                        @else
                                        Tidak ada data cicilan di bulan manapun
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
