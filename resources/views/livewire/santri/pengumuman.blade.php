<div class="">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            @forelse ($this->listPengumuman() as $item)
                <div data-bs-toggle="modal" wire:click='detailPengumuman("{{ $item->id }}")'
                    data-bs-target="#detailPengumuman" class= "card">
                    <div class="card-header">
                        <h5 class="m-0">{{ $item->judul }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-secondary m-0">{{ Str::limit($item->isi_pengumuman, 120, '...') }}</p>
                    </div>
                    <div class="card-footer">
                        <p>
                            <span
                                class="badge bg-primary">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-secondary">Belum ada kegiatan</p>
            @endforelse
        </div>
    </div>

    <div class="modal fade" id="detailPengumuman" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <p class="mb-2">{{ $detailPengumumanModal?->judul }}</p>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">{{ $detailPengumumanModal?->isi_pengumuman }}</p>
                </div>
                <div class="modal-footer justify-content-start">
                    <p class="mb-2">
                        {{ \Carbon\Carbon::parse($detailPengumumanModal?->tanggal)->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
