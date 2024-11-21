<div class="">
    <div class="table-transaksi">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Riwayat Detail Pembayaran</h4>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Pembayaran</th>
                                <th>Nama</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Metode Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TRX-001</td>
                                <td>Budi Setiawan</td>
                                <td>Sepatu Nike</td>
                                <td>2</td>
                                <td>Rp 1.500.000</td>
                                <td>Cash</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Detail
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>TRX-001</td>
                                <td>Budi Setiawan</td>
                                <td>Sepatu Nike</td>
                                <td>2</td>
                                <td>Rp 1.500.000</td>
                                <td>Cash</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Detail
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>TRX-001</td>
                                <td>Budi Setiawan</td>
                                <td>Sepatu Nike</td>
                                <td>2</td>
                                <td>Rp 1.500.000</td>
                                <td>Cash</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Detail
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>TRX-001</td>
                                <td>Budi Setiawan</td>
                                <td>Sepatu Nike</td>
                                <td>2</td>
                                <td>Rp 1.500.000</td>
                                <td>Cash</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Detail
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>TRX-001</td>
                                <td>Budi Setiawan</td>
                                <td>Sepatu Nike</td>
                                <td>2</td>
                                <td>Rp 1.500.000</td>
                                <td>Cash</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Detail
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#detailProduct">Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{ $this->listProduct()->links() }}
                </div>
            </div>
        </div>
    </div>
     <!-- Order Detail Modal -->
    <div class="modal fade" id="detailProduct" wire:ignore.self tabindex="-1">
        <div class="modal-dialog {{ $detailProductList?->foto ? 'modal-lg' : 'modal-md' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk #{{ $detailProductList?->product_number }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        @if ($detailProductList?->foto)
                            <div class="me-3" style="width: 100%; position: relative;">
                                <img src="{{ Storage::url('photos/' . $detailProductList?->foto) }}"
                                    class="img-fluid rounded"
                                    style="position: absolute; object-fit:cover; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <strong>Nama Produk:</strong>
                                    <p class="mb-1">{{ $detailProductList?->name }}</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Kategori:</strong>
                                    <p class="mb-1">
                                        {{ $detailProductList?->category?->name ?? 'Tidak Berkategori' }}
                                    </p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Harga:</strong>
                                    <p class="mb-1">Rp.
                                        {{ number_format($detailProductList?->price ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Stok:</strong>
                                    <p class="mb-1">{{ $detailProductList?->stok }} Unit</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Deskripsi:</strong>
                                    <p class="mb-1">{{ $detailProductList?->description ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                                <div class="col-12 mb-2">
                                    <strong>Dibuat Pada:</strong>
                                    <span class="badge bg-info">
                                        {{ $detailProductList?->created_at?->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
