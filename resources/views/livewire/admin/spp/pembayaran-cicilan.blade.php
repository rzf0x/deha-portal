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
                <div class="form search px-4 border border-2 py-2 rounded-3">
                    <input class="bg-transparent" style="border: none; outline: none;" type="text"
                        wire:model.live="search" placeholder="Cari santri...">
                    <i class="bi bi-search"></i>
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
                        @forelse ($santris as $santri)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
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
                                    <a href="{{ route('spp.detail-laporan-cicilan-santri', $santri->id) }}"
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
                {{ $santris->links() }}
            </div>
        </div>
    </div>
</div>
