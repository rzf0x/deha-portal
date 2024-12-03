<section>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Cucian</th>
                            <th>Nama Santri</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Quantity</th>
                            <th>Jenis Service</th>
                            <th>Subtotal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->listLaundry() as $laundry)
                            <tr>
                                <td>{{ $laundry->order_number }}</td>
                                <td>{{ $laundry->santri->nama }}</td>
                                <td>{{ $laundry->santri->kelas->nama }}</td>
                                <td>{{ $laundry->santri->kamar->nama }}</td>
                                <td>{{ $laundry->quantity }} {{ $laundry->laundryService->unit }}</td>
                                <td>{{ $laundry->laundryService->name }}</td>
                                <td>Rp. {{ number_format($laundry->subtotal, 0, ',', '.') }}</td>
                                <td>
                                    <span
                                        class="badge {{ $this->getBadgeClass($laundry->status) }}">{{ $laundry->status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#orderDetail"
                                            wire:click='detailLaundry("{{ $laundry->id }}")'>Detail
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click='deleteLaundry("{{ $laundry->id }}")'
                                            wire:confirm='Apakah kamu ingin menghapus riwayat {{ $laundry->order_number }}'>Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                    <p class="m-0">Riwayat tidak tersedia!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $this->listLaundry()->links() }}
            </div>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div class="modal fade" id="orderDetail" wire:ignore.self tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Cucian #{{ $detailLaundryUser?->order_number }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informasi Santri</h6>
                            <p class="mb-1">Nama: {{ $detailLaundryUser?->santri->nama }}</p>
                            <p class="mb-1">NISN: {{ $detailLaundryUser?->santri->nisn }}</p>
                            <p class="mb-1">Kelas: {{ $detailLaundryUser?->santri->kelas->nama }}</p>
                            <p class="mb-1">Kamar: {{ $detailLaundryUser?->santri->kamar->nama }}</p>
                            <p class="mb-1">Service: {{ $detailLaundryUser?->laundryService->name }}</p>
                            <p class="mb-1">Jumlah: {{ $detailLaundryUser?->quantity }}
                                {{ $detailLaundryUser?->laundryService->unit }}</p>
                            <p class="mb-1">Subtotal: Rp. {{ number_format($detailLaundryUser?->subtotal, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Cucian</h6>
                            <p class="mb-1">Lama Pengerjaan: {{ $detailLaundryUser?->laundryService->estimate }}
                            <p class="mb-1">Tanggal Masuk: {{ $detailLaundryUser?->created_at->format('d M Y') }}
                            </p>
                            <p class="mb-1">Estimasi Selesai:
                                {{ date('d M Y', strtotime($detailLaundryUser?->end_date)) }}</p>
                            <p class="mb-1">Status:
                                <span class="badge {{ $this->getBadgeClass($detailLaundryUser?->status) }}">
                                    {{ ucfirst($detailLaundryUser?->status) }}
                                    @if ($detailLaundryUser?->status == 'diterima')
                                        <span>{{ $detailLaundryUser?->updated_at->format('d M Y') }}</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
