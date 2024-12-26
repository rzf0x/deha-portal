<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="d-flex justify-content-end">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)" class="alert alert-success w-25">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <form wire:submit.prevent="$refresh" class="d-flex gap-3">
                    <input type="text" wire:model="search" class="form-control" placeholder="Cari Santri..."
                        required>
                    <button type="submit" class="btn btn-primary w-25">Cari</button>
                </form>
                <div class="d-flex gap-3 pl-5">
                    <select wire:model.live="filter.jenjang"
                        class="form-select py-2 rounded-3 border-2" wire:loading.attr="disabled">
                        <option value="">Pilih Jenjang</option>
                        @foreach ($jenjangOptions as $jenjang)
                            <option value="{{ $jenjang->nama }}">{{ $jenjang->nama }}</option>
                        @endforeach
                    </select>
    
                    <!-- Kelas Dropdown -->
                    <select wire:model.live="filter.kelas"
                        class="form-select py-2 rounded-3 border-2" wire:loading.attr="disabled">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelasOptions as $kelas)
                            <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="filter.tahun"
                        class="form-select py-2 rounded-3 border-2" wire:loading.attr="disabled">
                        <option value="">Pilih Tahun</option>
                        @foreach ($tahunOptions as $tahun)
                            <option value="{{ $tahun->nama_tahun }}">{{ $tahun->nama_tahun }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
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
                        @forelse ($santriResults as $index => $santri)
                            <tr>
                                <td class="text-center">{{ $santriResults->firstItem() + $index }}</td>
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
                                    <a href="{{ route('spp.detail-laporan-cicilan-santri', ['id' => $santri->id]) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    {{ $search ? 'Data tidak ditemukan!' : 'Tidak ada data yang ditampilkan' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $santriResults->links() }}
            </div>
        </div>
    </div>
</div>
