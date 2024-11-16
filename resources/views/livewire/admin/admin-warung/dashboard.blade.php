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
        <div class="row">
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
            <div class="col-lg-6 card-information-sales">
                <div class="row h-100">
                    <div class="col-lg-6 d-flex flex-column gap-4">
                        <div class="d-flex align-items-center bg-white  p-4 flex-grow-1 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Totak Produk</h5>
                                <h3 class="m-0 text-primary">67</h3>
                                <p class="m-0 fs-6 text-danger"><b>- 12</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center bg-white  p-4 flex-grow-1 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Produk Terjual</h5>
                                <h3 class="m-0 text-primary">291</h3>
                                <p class="m-0 fs-6 text-success"><b>+ 101</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex flex-column gap-4">
                        <div class="d-flex align-items-center bg-white  p-4 flex-grow-1 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Total Transaksi</h5>
                                <h3 class="m-0 text-primary">190</h3>
                                <p class="m-0 fs-6 text-success"><b>+ 83</b> <span class="text-dark">di bulan
                                        <b>November</b></span></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center bg-white  p-4 flex-grow-1 rounded-3">
                            <div class="d-flex flex-column gap-3">
                                <h5 class="mb-0">Total Pembeli</h5>
                                <h3 class="m-0 text-primary">76</h3>
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
                <h4 class="m-0">Tabel Produk</h4>
                <a class="btn btn-dark mt-md-0 mt-2" href="#">Semua produk</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="path_to_image1.jpg"
                                        style="width: 4rem; height: 4rem; border-radius: 10%; object-fit: cover;"
                                        alt="Produk 1">
                                </td>
                                <td>Produk A</td>
                                <td>Kategori 1</td>
                                <td>100</td>
                                <td>-41</td>
                                <td>Rp. 100.000</td>
                                <td><button class="btn btn-sm btn-primary text-white"><i class="bi bi-eye-fill"></i>
                                        Detail</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <img src="path_to_image2.jpg"
                                        style="width: 4rem; height: 4rem; border-radius: 10%; object-fit: cover;"
                                        alt="Produk 2">
                                </td>
                                <td>Produk B</td>
                                <td>Kategori 2</td>
                                <td>50</td>
                                <td>-21</td>
                                <td>Rp. 200.000</td>
                                <td><button class="btn btn-sm btn-primary text-white"><i class="bi bi-eye-fill"></i>
                                        Detail</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <img src="path_to_image3.jpg"
                                        style="width: 4rem; height: 4rem; border-radius: 10%; object-fit: cover;"
                                        alt="Produk 3">
                                </td>
                                <td>Produk C</td>
                                <td>Kategori 3</td>
                                <td>200</td>
                                <td>-10</td>
                                <td>Rp. 150.000</td>
                                <td><button class="btn btn-sm btn-primary text-white"><i class="bi bi-eye-fill"></i>
                                        Detail</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <img src="path_to_image4.jpg"
                                        style="width: 4rem; height: 4rem; border-radius: 10%; object-fit: cover;"
                                        alt="Produk 4">
                                </td>
                                <td>Produk D</td>
                                <td>Kategori 4</td>
                                <td>75</td>
                                <td>-32</td>
                                <td>Rp. 300.000</td>
                                <td><button class="btn btn-sm btn-primary text-white"><i class="bi bi-eye-fill"></i>
                                        Detail</button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <img src="path_to_image5.jpg"
                                        style="width: 4rem; height: 4rem; border-radius: 10%; object-fit: cover;"
                                        alt="Produk 5">
                                </td>
                                <td>Produk E</td>
                                <td>Kategori 5</td>
                                <td>150</td>
                                <td>-45</td>
                                <td>Rp. 250.000</td>
                                <td><button class="btn btn-sm btn-primary text-white"><i class="bi bi-eye-fill"></i>
                                        Detail</button></td>
                            </tr>
                        </tbody>
                    </table>
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
