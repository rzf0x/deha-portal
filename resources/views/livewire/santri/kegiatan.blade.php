<div class="">
    <div class="row">
        @forelse ($this->listKegiatan() as $item)
            <div style="cursor: pointer;" class="col-lg-4 col-md-6 col-12">
                <div data-bs-toggle="modal" wire:click='detailKegiatan("{{ $item->id }}")'
                    data-bs-target="#detailKegiatan" class="card">
                    <div class="card-header">
                        <h5 class="m-0">{{ $item->judul }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-secondary m-0">{{ Str::limit($item->isi_kegiatan, 80, '...') }}</p>
                    </div>
                    <div class="px-4">
                        <p>
                            <span
                                class="badge bg-primary">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }}</span>
                            - <span class="badge bg-warning">
                                {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary">Belum ada kegiatan</p>
        @endforelse
    </div>

    <div class="modal fade" id="detailKegiatan" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $detailKegiatanModal?->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><b>{{ $detailKegiatanModal?->isi_kegiatan }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2">
                        {{ \Carbon\Carbon::parse($detailKegiatanModal?->waktu_mulai)->format('d M Y H:i') }}</p>
                    <p class="mb-2">
                        {{ \Carbon\Carbon::parse($detailKegiatanModal?->waktu_selesai)->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
