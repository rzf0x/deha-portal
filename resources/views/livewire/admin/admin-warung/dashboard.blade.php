<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex flex-md-row flex-column justify-content-between align-items-md-center">
            <h4>Revenue</h4>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-2 col-12">
                    <select class="form-select" style="width: 100%;">
                        <option value="">November</option>
                    </select>
                </div>
                <div class="col-md-6 mt-md-0 mt-2 col-12">
                    <select class="form-select" style="width: 100%;">
                        <option value="">2024</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row px-lg-4 px-2">
            <div class="col-lg-6 chart-container">
                <div class="chart-revenue bg-white p-4 rounded-3 d-flex flex-column">
                    <header class="chart-header row">
                        <div class="">
                            <h5 class="mb-3">Pendapatan</h5>
                            <div class="d-flex gap-3 align-items-center">
                                <h2 class="m-0 text-primary">Rp. 478.511</h2>
                                <p class="m-0 fs-6 text-success">(+ Rp. 78.900)</p>
                            </div>
                        </div>
                    </header>
                    <div id="chart-pendapatan" style="height: 250px;" class="chart mt-2 rounded-3 w-100 flex-grow-1">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <!-- Total Produk -->
                    <div class="col-md-6 col-12 mb-4">
                        <div style="background-color: #f5f5f5;" class="d-flex align-items-center p-4 h-100 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Total Produk</h5>
                                <h3 class="m-0 text-primary">67</h3>
                                <p class="m-0 fs-6 text-danger"><b>- 12</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                    </div>
                    <!-- Produk Terjual -->
                    <div class="col-md-6 col-12 mb-4">
                        <div style="background-color: #f5f5f5;" class="d-flex align-items-center p-4 h-100 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Produk Terjual</h5>
                                <h3 class="m-0 text-primary">291</h3>
                                <p class="m-0 fs-6 text-success"><b>+ 101</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                    </div>
                    <!-- Total Transaksi -->
                    <div class="col-md-6 col-12 mb-4">
                        <div style="background-color: #f5f5f5;" class="d-flex align-items-center p-4 h-100 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Total Transaksi</h5>
                                <h3 class="m-0 text-primary">190</h3>
                                <p class="m-0 fs-6 text-success"><b>+ 83</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                    </div>
                    <!-- Total Pembeli -->
                    <div class="col-md-6 col-12 mb-4">
                        <div style="background-color: #f5f5f5;" class="d-flex align-items-center p-4 h-100 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Total Stok</h5>
                                <h3 class="m-0 text-primary">861</h3>
                                <p class="m-0 fs-6 text-success"><b>+ 54</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-produk mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Tabel Produk - ({{ count($this->listProduct()) }})</h4>
                <a class="btn btn-dark mt-md-0 mt-2" href="{{ route('petugas-warung.produk') }}">Semua produk</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Produk</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->listProduct() as $product)
                                <tr>
                                    <td>{{ $product->product_number }}</td>
                                    <td>
                                        @if ($product->foto)
                                            <img style="width: 5rem; height: 5rem; object-fit:cover;"
                                                src="{{ Storage::url('photos/' . $product->foto) }}" alt="">
                                        @else
                                            <p class="m-0">Foto tidak tersedia!</p>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'Tidak Berkategori' }}</td>
                                    <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stok }}</td>
                                    <td>46</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailProduct"
                                            wire:click="detailProduct('{{ $product->id }}')">Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <p class="m-0">Tidak ada produk tersedia!</p>
                                    </td>
                                </tr>
                            @endforelse
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Bar Chart (Pendapatan Penjualan Produk)
    var pendapatanOptions = {
        series: [{
            name: 'Pendapatan',
            data: [150000, 200000, 180000, 250000, 300000] // Data total pendapatan dari penjualan produk
        }],
        chart: {
            type: 'line',
            height: 250,
            stacked: false,
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#ff6347', '#32cd32'],
        xaxis: {
            categories: ['Produk A', 'Produk B', 'Produk C', 'Produk D', 'Produk E'], // Ganti dengan nama produk
        },
        yaxis: {
            min: 0,
            max: 400000,
            tickAmount: 8,
        },
        legend: {
            position: 'top',
            fontSize: '14px',
        },
        stroke: {
            curve: 'smooth',
            width: 2,
        },
        markers: {
            size: 4,
            strokeColor: '#ff6347',
            strokeWidth: 2,
            fillOpacity: 1,
            shape: 'circle',
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }]
    };

    var chartPendapatan = new ApexCharts(document.querySelector("#chart-pendapatan"), pendapatanOptions);
    chartPendapatan.render();
</script>
