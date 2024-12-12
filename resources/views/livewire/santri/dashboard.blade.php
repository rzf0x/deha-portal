<div class="">
    <!-- Top Bar -->
    <div class="mb-md-3 d-flex md-2">
        <img class="bg-secondary" src="" alt="">
        <div class="">
            <h2 class="fw-bold text-dark">Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}</h2>
        </div>
    </div>
    <!-- Dashboard Grid -->
    <div class="row">
        <!-- Profile Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Informasi Pribadi</h3>
                        <div class="btn btn-dark">
                            <a class="text-white" href="{{ route('santri.profile') }}">Profile</a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-2 ">Nama Lengkap</h6>
                        <p class="fw-medium">{{ auth()->user()->name ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Email</h6>
                        <p class="fw-medium">{{ auth()->user()->email ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Password</h6>
                        <p class="fw-medium">{{ auth()->user()->password ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Jenjang</h6>
                        <p class="fw-medium">{{ $profile?->kelas->jenjang->nama ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Kelas</h6>
                        <p class="fw-medium">{{ $profile?->kelas->nama ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Kamar</h6>
                        <p class="fw-medium">{{ $profile?->kamar->nama ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- SPP Status Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title">Status SPP</h3>
                        <div class="form-group">
                            <select wire:model.live='setStatusSpp' class="form-control form-control-md" name=""
                                id="">
                                @forelse ($timeline_spp as $timeline)
                                    <option value="{{ $timeline->nama_bulan }}">{{ $timeline->nama_bulan }}</option>
                                @empty
                                    <option value="">Tidak ada bulan!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="status-spp">
                        @php
                            $statusClass = 'bg-secondary';
                            if (isset($pembayaran)) {
                                switch ($pembayaran->status) {
                                    case 'lunas':
                                        $statusClass = 'bg-success';
                                        break;
                                    case 'cicilan':
                                        $statusClass = 'bg-warning';
                                        break;
                                }
                            }
                        @endphp
                        Status Pembayaran: <span
                            class="badge ms-1 {{ $statusClass }}">{{ $pembayaran->status ?? 'belum bayar' }}</span>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Perkembangan Akademik</h3>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="card-subtitle">Tahfidz</span>
                            <span class="card-subtitle">80%</span>
                        </div>
                        <div class="progress rounded-5">
                            <div class="progress-bar rounded-5 bg-primary" role="progressbar" style="width: 80%;"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="card-subtitle">Bahasa Arab</span>
                            <span class="card-subtitle">65%</span>
                        </div>
                        <div class="progress rounded-5">
                            <div class="progress-bar bg-warning rounded-5" role="progressbar" style="width: 65%;"
                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="card-subtitle">Fiqih</span>
                            <span class="card-subtitle">90%</span>
                        </div>
                        <div class="progress rounded-5">
                            <div class="progress-bar bg-success rounded-5" role="progressbar" style="width: 90%;"
                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Schedule Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Jadwal Hari Ini</h3>
                        <div class="form-group">
                            <select class="form-control form-control-md" name="" id="">
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jum'at</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-column gap-md-3 gap-2">
                        <div class="py-2 px-3 rounded" style="background-color: #f5f5f5">
                            <h6 class="fw-medium mb-2">Tahfidz</h6>
                            <p class="card-subtitle mb-0">04:30 - 06:00</p>
                        </div>
                        <div class="py-2 px-3 rounded" style="background-color: #f5f5f5">
                            <h6 class="fw-medium mb-2">Tahfidz</h6>
                            <p class="card-subtitle mb-0">04:30 - 06:00</p>
                        </div>
                        <div class="py-2 px-3 rounded" style="background-color: #f5f5f5">
                            <h6 class="fw-medium mb-2">Tahfidz</h6>
                            <p class="card-subtitle mb-0">04:30 - 06:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Announcements Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title">Pengumuman</h3>
                        <a href="{{ route('santri.pengumuman') }}"
                            class="d-none d-md-block text-dark text-decoration-underline">Lihat
                            Semua</a>
                    </div>
                    @forelse ($this->listPengumuman() as $item)
                        <div data-bs-toggle="modal" wire:click='detailPengumuman("{{ $item->id }}")'
                            data-bs-target="#detailPengumuman" class="mt-4">
                            <div class="border-start border-info ps-3">
                                <h6 class="fw-medium mb-2">{{ $item->judul }}</h6>
                                <p class="card-subtitle mb-0">
                                    {{ Str::limit($item->isi_pengumuman, 24, '...') ?? '-' }}
                                </p>
                                <p class="text-muted small mt-1">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mt-1">Belum ada pengumuman</p>
                    @endforelse
                    <a href="{{ route('santri.pengumuman') }}"
                        class="d-md-none mt-md-4 mt-3 w-100 btn btn-dark">Lihat
                        Semua Pengumuman</a>
                </div>
            </div>
        </div>
        <!-- Duty Roster Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Jadwal Piket</h3>
                    <div class="mt-4">
                        <div style="background-color: #f5f5f5;"
                            class="p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-medium mb-2">Senin</h6>
                                <p class="card-subtitle mb-0">Membersihkan Masjid</p>
                            </div>
                            <span class="badge bg-primary">Pagi</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div style="background-color: #f5f5f5;"
                            class="p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-medium mb-2">Kamis</h6>
                                <p class="card-subtitle mb-0">Membersihkan Kelas</p>
                            </div>
                            <span class="badge bg-purple">Sore</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div style="background-color: #f5f5f5;"
                            class="p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-medium mb-2">Sabtu</h6>
                                <p class="card-subtitle mb-0">Kerja Bakti</p>
                            </div>
                            <span class="badge bg-purple">Sore</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Activities Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="card-title">Kegiatan Mendatang</h3>
                        <a href="{{ route('santri.kegiatan') }}"
                            class="d-none d-md-block text-dark text-decoration-underline">Lihat
                            Semua</a>
                    </div>
                    @forelse ($this->listKegiatan() as $item)
                        <div data-bs-toggle="modal" wire:click='detailKegiatan("{{ $item->id }}")'
                            data-bs-target="#detailKegiatan" class="mt-lg-3 mt-2">
                            <div style="background-color: #f5f5f5;" class="p-3">
                                <h6 class="fw-medium mb-2">{{ $item->judul }}</h6>
                                <p class="card-subtitle mb-0">
                                    {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }} -
                                    {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mt-1">Belum ada kegiatan</p>
                    @endforelse
                    <a href="{{ route('santri.kegiatan') }}" class="d-md-none mt-md-4 mt-3 w-100 btn btn-dark">Lihat
                        Semua Kegiatan</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailKegiatan" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $detailKegiatanModal?->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><b>{{ $detailKegiatanModal?->isi_kegiatan ?? '-' }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2">
                        {{ \Carbon\Carbon::parse($detailKegiatanModal?->waktu_mulai)->format('d M Y H:i') ?? '-' }}</p>
                    <p class="mb-2">
                        {{ \Carbon\Carbon::parse($detailKegiatanModal?->waktu_selesai)->format('d M Y H:i') ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailPengumuman" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <p class="mb-2">{{ $detailPengumumanModal?->judul ?? '-' }}</p>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">{{ $detailPengumumanModal?->isi_pengumuman ?? '-' }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2">
                        {{ \Carbon\Carbon::parse($detailPengumumanModal?->tanggal)->format('d M Y') ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
