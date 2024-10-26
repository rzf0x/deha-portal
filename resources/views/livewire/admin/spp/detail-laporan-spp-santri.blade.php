<div>
    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 2500)" 
                class="alert alert-success w-25">
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
                            <td>: <span class="badge bg-info">{{ $santri->kelas?->nama ?? 'Belum ada kelas' }}</span></td>
                        </tr>
                        <tr>
                            <td>Kamar</td>
                            <td>: <span class="badge bg-warning text-dark">{{ $santri->kamar?->nama ?? 'Belum ada kamar' }}</span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Pembayaran</h6>
                                    <h3>{{ number_format($total_pembayaran) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Nominal</h6>
                                    <h3>Rp {{ number_format($total_nominal) }}</h3>
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
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="filter.status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="pending">Pending</option>
                        <option value="belum-bayar">Belum Bayar</option>
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
                            <th>Metode</th>
                            <th>Status</th>
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
                                        {{ str($bayar->metode_pembayaran)->title() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ match($bayar->status) {
                                        'lunas' => 'bg-success',
                                        'pending' => 'bg-warning text-dark',
                                        default => 'bg-danger'
                                    } }}">
                                        {{ str($bayar->status)->title() }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pembayaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $pembayaran->links() }}
            </div>
        </div>
    </div>
</div>