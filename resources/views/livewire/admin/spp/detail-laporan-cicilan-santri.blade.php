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
                                    <h6 class="card-title">Total Cicilan</h6>
                                    <h3 class="text-white">{{ number_format($total_cicilan) }}</h3>
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
                <h5 class="card-title">Riwayat Cicilan</h5>
                <div class="d-flex gap-2">
                    <select wire:model.live="filter.tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cicilan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($item->nominal) }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data cicilan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
