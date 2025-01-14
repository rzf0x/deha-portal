<div class="px-3">
    <h3 class="m-0 mb-4 text-dark mt-3">Pengumuman</h3>
    <div style="margin-bottom: 5rem;" class="row px-3">
        @forelse ($this->listPengumuman() as $item)
            <div style="cursor: pointer;" class="bg-white rounded-3 p-3 mb-3 col-12">
                <div data-bs-toggle="modal" wire:click='detailPengumuman("{{ $item->id }}")'
                    data-bs-target="#detailPengumuman" class="">
                    <div class="border-start border-info ps-3">
                        <h6 class="fw-bold text-dark mb-2">{{ $item->judul }}</h6>
                        <p class="card-subtitle text-dark mb-0">
                            {{ Str::limit($item->isi_pengumuman, 64, '...') ?? '-' }}
                        </p>
                        <p class="text-secondary mb-0 small mt-1">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary">Belum ada pengumuman</p>
        @endforelse
    </div>

    <div class="modal fade" id="detailPengumuman" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <p class="mb-2 text-dark">{{ $detailPengumumanModal?->judul }}</p>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-dark">{{ $detailPengumumanModal?->isi_pengumuman }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2 small text-dark">
                        {{ \Carbon\Carbon::parse($detailPengumumanModal?->tanggal)->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
