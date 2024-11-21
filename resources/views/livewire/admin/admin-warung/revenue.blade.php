<div class="container-fluid py-4">
    <div class="card p-4">
        <div class="row p-0">
            <!-- Total Produk -->
            <div class="col-lg-3 col-md-6 col-12 pt-0">
                <div style="background-color: #f5f5f5;" class="d-flex align-items-center p-4 h-100 rounded-3">
                    <div class="d-flex flex-column gap-3">
                        <h5 class="mb-0">Pendapatan</h5>
                        <h3 class="m-0 text-primary">Rp. 471.000</h3>
                        <p class="m-0 fs-6 text-success"><b>+ Rp. 78.900</b> <span class="text-dark">di bulan
                                <b>November</b></span></p>
                    </div>
                </div>
            </div>
            <!-- Produk Terjual -->
            <div class="col-lg-3 col-md-6 col-12 pt-md-0 pt-3">
                <div style="background-color: #f5f5f5;" class="d-flex align-items-center p-4 h-100 rounded-3">
                    <div class="d-flex flex-column gap-3">
                        <h5 class="mb-0">Produk Terjual</h5>
                        <h3 class="m-0 text-primary">32</h3>
                        <p class="m-0 fs-6 text-success"><b>+ 11</b> <span class="text-dark">di bulan
                                <b>November</b></span></p>
                    </div>
                </div>
            </div>
            <!-- Total Transaksi -->
            <div class="col-lg-3 col-md-6 col-12 pt-lg-0 pt-md-4 pt-3">
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
            <div class="col-lg-3 col-md-6 col-12 pt-lg-0 pt-md-4 pt-3">
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
    <div class="card">
        <div class="card-header d-flex flex-md-row flex-column justify-content-between align-items-md-center">
            <h4>Statistik Penjualan</h4>
            <div class="row">
                <div class="col-md-6 mt-md-0 col-12">
                    <select class="form-select" style="width: 100%;">
                        <option value="">November</option>
                    </select>
                </div>
                <div class="col-md-6 mt-md-0 col-12">
                    <select class="form-select" style="width: 100%;">
                        <option value="">2024</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row px-lg-4 px-2">
            <div class="col-lg-8 chart-container">
                <div class="chart-revenue bg-white p-4 rounded-3 d-flex flex-column">
                    <header class="chart-header row">
                        <h5 class="mb-3">Total Penjualan</h5>
                    </header>
                    <div id="chart-pendapatan" style="height: 350px;"
                        class="chart mt-2 rounded-3 h-100 w-100 flex-grow-1">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 chart-container">
                <div class="chart-revenue bg-white p-4 rounded-3 d-flex flex-column">
                    <header class="chart-header row">
                        <h5 class="mb-3">Top 3 Produk Terlaku</h5>
                    </header>
                    <div id="chart-top-produk" style="height: 350px;"
                        class="chart h-100 mt-2 rounded-3 w-100 flex-grow-1">
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
                                            <img style="width: 3rem; border-radius: 50%; height: 3rem; object-fit:cover;"
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

    <div class="table-transaksi mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Riwayat Detail Pembayaran</h4>
                <a class="btn btn-dark mt-md-0 mt-2" href="{{ route('petugas-warung.detail-pembayaran') }}">Lihat
                    semua</a>
            </div>
            <div class="card-body">
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
                                        data-bs-target="#detailProduct"
                                        wire:click="detailProduct('{{ $product->id }}')">Detail
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
                                        data-bs-target="#detailProduct"
                                        wire:click="detailProduct('{{ $product->id }}')">Detail
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
                                        data-bs-target="#detailProduct"
                                        wire:click="detailProduct('{{ $product->id }}')">Detail
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
                                        data-bs-target="#detailProduct"
                                        wire:click="detailProduct('{{ $product->id }}')">Detail
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
                                        data-bs-target="#detailProduct"
                                        wire:click="detailProduct('{{ $product->id }}')">Detail
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Bar Chart (Pendapatan Penjualan Produk)
    var pendapatanOptions = {
        series: [{
            name: 'Terjual',
            data: [20, 12, 15, 9, 30] // Data total pendapatan dari penjualan produk
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: false,
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#ff6347'],
        xaxis: {
            categories: ['Produk A', 'Produk B', 'Produk C', 'Produk D', 'Produk E'], // Ganti dengan nama produk
        },
        yaxis: {
            min: 0,
            // max: 400000,
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

    const options = {
        series: [531, 412, 441],
        chart: {
            type: 'pie',
            height: 350
        },
        labels: ['Nasi Goreng', 'Es Buah', 'Air Putih'],
        colors: ['#FF6B9E', '#435BEB', '#FFD700'],
        legend: {
            position: 'bottom'
        },
        dataLabels: {
            formatter: function(val, opts) {
                return opts.w.globals.series[opts.seriesIndex].toLocaleString('id-ID') + ' Pcs';
            }
        }
    };

    const chart = new ApexCharts(document.getElementById('chart-top-produk'), options);
    chart.render();
</script>
