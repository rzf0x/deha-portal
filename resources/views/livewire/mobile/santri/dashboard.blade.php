<div class="mx-3 mt-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="position-relative" style="width: 60px; height: 60px;">
                @if ($profile && $profile->foto)
                    <img class="img-fluid rounded-circle" src="{{ Storage::url($profile->foto) }}"
                        alt="" style="object-fit: cover; width: 100%; height: 100%;">
                @else
                    <img class="img-fluid rounded-circle"
                        src="https://a.storyblok.com/f/191576/1200x800/a3640fdc4c/profile_picture_maker_before.webp"
                        alt="" style="object-fit: cover; width: 100%; height: 100%;">
                @endif
            </div>
            <div class="">
                <h class="mb-0 text-dark fw-bold">Halo, {{ explode(' ', auth()->user()->name)[0] }}!</h>
                <p class="m-0 mt-1"><span class="badge bg-primary">{{ $profile?->kelas->nama ?? '-' }}</span></p>
            </div>
        </div>
        <a wire:navigate href="{{ route('santri.profile') }}" class="">
            <i class="bi text-dark fs-4 bi-eye"></i>
        </a>
    </div>
    <div class="">
        <div class="scroll-container">
            <div class="card bg-primary mt-4 shadow">
                <div class="card-body">
                    <h6 class="card-title text-white">Perkembangan Akademik</h6>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="card-subtitle text-dark text-white">Tahfidz</span>
                            <span class="card-subtitle text-dark text-white">80%</span>
                        </div>
                        <div style="background-color: #c0c0c0; height: 8px;" class="progress rounded-5">
                            <div class="progress-bar rounded-5 bg-white" role="progressbar"
                                style="width: 80%; height: 100%;" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-primary mt-4 shadow">
                <div class="card-body">
                    <h6 class="card-title text-white">Perkembangan Akademik</h6>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="card-subtitle text-dark text-white">Tahfidz</span>
                            <span class="card-subtitle text-dark text-white">80%</span>
                        </div>
                        <div style="background-color: #c0c0c0; height: 8px;" class="progress rounded-5">
                            <div class="progress-bar rounded-5 bg-white" role="progressbar"
                                style="width: 80%; height: 100%;" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title text-dark m-0 d-inline-flex align-items-center gap-2">Status SPP <div
                            class="status-spp">
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
                            <span class="badge {{ $statusClass }}">{{ $pembayaran->status ?? 'belum bayar' }}</span>
                        </div>
                    </h6>
                    <div class="">
                        <select wire:model.live='setStatusSpp' class="form-control form-control-sm" name=""
                            id="">
                            @forelse ($timeline_spp as $timeline)
                                <option value="{{ $timeline->nama_bulan }}">{{ $timeline->nama_bulan }}</option>
                            @empty
                                <option value="">Tidak ada bulan!</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex mb-3 align-items-center justify-content-between">
                <h6 class="card-title text-dark">Jadwal Hari Ini</h6>
                <div class="form-group">
                    <select class="form-control form-control-sm" name="" id="">
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jum'at</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-column gap-md-3 gap-2">
                <div class="d-flex justify-content-between align-items-center pb-2 rounded">
                    <div>
                        <h6 class="fw-medium text-dark mb-2">Tahfidz</h6>
                        <p class="card-subtitle text-dark mb-0">04:30 - 06:00</p>
                    </div>
                    <span class="badge bg-success">Sekarang</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pb-2 rounded">
                    <div>
                        <h6 class="fw-medium text-dark mb-2">Tahfidz</h6>
                        <p class="card-subtitle text-dark mb-0">04:30 - 06:00</p>
                    </div>
                    <span class="badge bg-success">Sekarang</span>
                </div>
                <div class="d-flex justify-content-between align-items-center rounded">
                    <div>
                        <h6 class="fw-medium text-dark mb-2">Tahfidz</h6>
                        <p class="card-subtitle text-dark mb-0">04:30 - 06:00</p>
                    </div>
                    <span class="badge bg-success">Sekarang</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-dark">Jadwal Piket</h6>
                <div class="mt-4">
                    <div style="background-color: #f5f5f5;"
                        class="p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-medium text-dark mb-2">Senin</h6>
                            <p class="card-subtitle text-dark mb-0">Membersihkan Masjid</p>
                        </div>
                        <span class="badge bg-primary">Pagi</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div style="background-color: #f5f5f5;"
                        class="p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-medium text-dark mb-2">Kamis</h6>
                            <p class="card-subtitle text-dark mb-0">Membersihkan Kelas</p>
                        </div>
                        <span class="badge bg-warning">Sore</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div style="background-color: #f5f5f5;"
                        class="p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-medium text-dark mb-2">Sabtu</h6>
                            <p class="card-subtitle text-dark mb-0">Kerja Bakti</p>
                        </div>
                        <span class="badge bg-primary">Sore</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card">
            <div class="card-body d-flex flex-column gap-2">
                <div class="d-flex mb-3 justify-content-between align-items-center mb-3">
                    <h6 class="card-title text-dark">Pengumuman</h6>
                    <a href="{{ route('santri.pengumuman') }}" class="btn btn-dark btn-sm">Lihat
                        Semua</a>
                </div>
                @forelse ($this->listPengumuman() as $item)
                    <div style="background-color: #f5f5f5;" data-bs-toggle="modal" wire:click='detailPengumuman("{{ $item->id }}")'
                        data-bs-target="#detailPengumuman" class="p-3">
                        <div class="border-start border-info ps-3">
                            <h6 class="fw-bold text-dark mb-2">{{ $item->judul }}</h6>
                            <p class="fw-medium text-dark mb-0">
                                {{ Str::limit($item->isi_pengumuman, 64, '...') ?? '-' }}
                            </p>
                            <p class="text-dark small mt-1 mb-0">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mt-1">Belum ada pengumuman</p>
                @endforelse
            </div>
        </div>
    </div>

    <div style="margin-bottom: 6rem;" class="mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-3 justify-content-between align-items-center mb-3">
                    <h6 class="m-0 text-dark card-title">Kegiatan Mendatang</h6>
                    <a href="{{ route('santri.kegiatan') }}" class="btn btn-sm btn-dark">Lihat
                        Semua</a>
                </div>
                @forelse ($this->listKegiatan() as $item)
                    <div data-bs-toggle="modal" wire:click='detailKegiatan("{{ $item->id }}")'
                        data-bs-target="#detailKegiatan" class="mt-3 rounded-3">
                        <div style="background-color: #f5f5f5;" class="p-3">
                            <h6 class="fw-medium text-dark mb-2">{{ $item->judul }}</h6>
                            <p class="small text-dark mb-0">
                                {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }} -
                                {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') ?? '-' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mt-1">Belum ada kegiatan</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailKegiatan" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">{{ $detailKegiatanModal?->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-dark"><b>{{ $detailKegiatanModal?->isi_kegiatan ?? '-' }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2 text-dark">
                        {{ \Carbon\Carbon::parse($detailKegiatanModal?->waktu_mulai)->format('d M Y H:i') ?? '-' }} -
                        {{ \Carbon\Carbon::parse($detailKegiatanModal?->waktu_selesai)->format('d M Y H:i') ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailPengumuman" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <p class="mb-2 text-dark">{{ $detailPengumumanModal?->judul ?? '-' }}</p>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-dark">{{ $detailPengumumanModal?->isi_pengumuman ?? '-' }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2 text-dark">
                        {{ \Carbon\Carbon::parse($detailPengumumanModal?->tanggal)->format('d M Y') ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
