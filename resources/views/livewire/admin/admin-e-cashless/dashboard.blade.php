<div class="container-fluid py-4">
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats ">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total saldo</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <h4 class="mb-0">Rp. 712.773</h4>
                            <h6 class="mb-0 text-success">(+ 471.213)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats ">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Transaksi Warung</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <h4 class="mb-0">766</h4>
                            <h6 class="mb-0 text-info">(+ 471)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats ">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Transaksi Laundry</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <h4 class="mb-0">523</h4>
                            <h6 class="mb-0 text-warning">(+ 66)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Menunggu Pembayaran</h6>
                        <h4 class="mb-0">1 Transaksi</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card mb-0 mb-4">
        {{-- <div class="card-header">
            <h5 class="card-title mb-0">Grafik Transaksi November 2024</h5>
        </div> --}}
        <div class="card-header bg-transparent">
            <div class="row">
                <!-- Title -->
                <div class="col-12 col-md-9 d-flex align-items-center mb-2 mb-sm-0">
                    <h5 class="card-title fs-5 mb-0">Grafik Pendapatan di November 2024</h5>
                </div>
                <!-- Filters and "Lihat semua" -->
                <div class="col-12 gap-3 col-md-3 d-flex justify-content-sm-end align-items-center">
                    <select class="form-select form-select-md" aria-label="Filter Bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select class="form-select form-select-md" aria-label="Filter Tahun">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="transactionChart"></div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <ul class="nav nav-tabs card-header-tabs col-12 col-md-7 d-flex align-items-center mb-2 mb-md-0"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#warung">Transaksi Warung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#laundry">Transaksi Laundry</a>
                    </li>
                </ul>
                <div
                    class="col-12 col-md-5 d-flex mt-md-0 mt-4 flex-column flex-md-row justify-content-md-end align-items-start align-items-md-center gap-2">
                    <input type="text" class="form-control" placeholder="Search" />

                    <select class="form-select" aria-label="Filter Bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select class="form-select" aria-label="Filter Tahun">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body mt-4">
            <div class="tab-content">
                <!-- Warung Transactions -->
                <div class="tab-pane fade show active" id="warung">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Item</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TRX-001</td>
                                    <td>16 Mar 2024 14:30</td>
                                    <td>
                                        <div>2x Mie Goreng</div>
                                        <div>3x Es Teh</div>
                                    </td>
                                    <td>Rp 45.000</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Laundry Transactions -->
                <div class="tab-pane fade" id="laundry">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Service</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>LDY-001</td>
                                    <td>16 Mar 2024 10:00</td>
                                    <td>Cuci Setrika</td>
                                    <td>3 kg</td>
                                    <td>Rp 30.000</td>
                                    <td><span class="badge bg-danger text-dark text-white">Gagal</span></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js"></script>
<script>
    var options = {
        series: [{
            name: 'Warung',
            data: [45000, 35000, 25000, 50000, 30000, 45000, 40000]
        }, {
            name: 'Laundry',
            data: [20000, 0, 30000, 0, 20000, 25000, 0]
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        colors: ['#0d6efd', '#198754'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        // grid: {
        //     borderColor: '#e7e7e7',
        //     row: {
        //         colors: ['#f3f3f3', 'transparent'],
        //         opacity: 0.5
        //     },
        // },
        markers: {
            size: 1
        },
        xaxis: {
            categories: ['10 Mar', '11 Mar', '12 Mar', '13 Mar', '14 Mar', '15 Mar', '16 Mar'],
            // title: {
            //     text: 'Tanggal'
            // }
        },
        yaxis: {
            // title: {
            //     text: 'Jumlah (Rp)'
            // },
            labels: {
                formatter: function(val) {
                    return 'Rp ' + val.toFixed(0);
                }
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return 'Rp ' + val.toFixed(0);
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#transactionChart"), options);
    chart.render();
</script>
