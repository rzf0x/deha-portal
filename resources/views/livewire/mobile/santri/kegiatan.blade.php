<div class="px-3">
    <h3 class="m-0 mb-4 text-dark mt-3">Kegiatan</h3>
    <div style="margin-bottom: 5rem;" class="row">
        @forelse ($this->listKegiatan() as $item)
            <div data-bs-toggle="modal" wire:click='detailKegiatan("{{ $item->id }}")' data-bs-target="#detailKegiatan"
                class="mb-3 rounded-3">
                <div style="background-color: #f5f5f5;" class="p-3">
                    <h6 class="fw-bold mb-2 text-dark">{{ $item->judul }}</h6>
                    <p class="text-dark small m-0">{{ Str::limit($item->isi_kegiatan, 48, '...') }}</p>
                    <p class="small text-secondary mt-2 mb-0">
                        {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }} -
                        {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') ?? '-' }}</p>
                </div>
            </div>
        @empty
            <p class="text-secondary">Belum ada kegiatan</p>
        @endforelse
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
</div>
