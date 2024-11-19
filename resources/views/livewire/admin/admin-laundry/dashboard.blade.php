<div class="container-fluid p-4">
    <!-- Metrics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted mb-1">Total yang Pesan</div>
                            <div class="h3 mb-0">250</div>
                            <div class="text-info mt-1">
                                Laundry bulanan santri
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted mb-1">Cucian bulan November</div>
                            <div class="h3 mb-0">45</div>
                            <div class="text-success mt-1">
                                <i class="fas fa-arrow-up me-1"></i>+ 15 order baru
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted mb-1">Total Kamar</div>
                            <div class="h3 mb-0">8</div>
                            <div class="text-warning mt-1">
                                8 Kamar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 mb-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted mb-1">Total Service</div>
                            <div class="h3 mb-0">10</div>
                            <div class="text-primary mt-1">
                                Jenis service laundry
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="card border-0 mb-0">
                <div class="card-header bg-transparent">
                    <h5 class="card-title fs-5 mb-0">Statistik Cucian di bulan November</h5>
                </div>
                <div class="card-body">
                    <div id="asramaChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0 mb-0">
                <div class="card-header bg-transparent">
                    <h5 class="card-title fs-5 mb-0">Status di bulan November</h5>
                </div>
                <div class="card-body">
                    <div id="statusChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 mb-0">
        <div class="card-header bg-transparent">
            <div class="row">
                <!-- Title -->
                <div class="col-12 col-sm-6 d-flex align-items-center mb-2 mb-sm-0">
                    <h5 class="card-title fs-5 mb-0">Daftar Laundry</h5>
                </div>
                <!-- Filters and "Lihat semua" -->
                <div class="col-12 col-sm-6 d-flex justify-content-sm-end align-items-center">
                    <!-- Filter Bulan -->
                    <div class="me-2 mb-2 mb-sm-0">
                        <select class="form-select form-select-sm" aria-label="Filter Bulan">
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
                    </div>
                    <!-- Filter Tahun -->
                    <div class="me-2 mb-2 mb-sm-0">
                        <select class="form-select form-select-sm" aria-label="Filter Tahun">
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <!-- Link Lihat Semua -->
                    <a href="{{ route('petugas-laundry.list-laundry') }}" class="text-primary">Lihat semua</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Cucian</th>
                            <th>Nama Santri</th>
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Jumlah Item</th>
                            <th>Jenis Service</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#LS-2024001</td>
                            <td>Ahmad Faiz</td>
                            <td>XI A</td>
                            <td>Ummar bin Khattab</td>
                            <td>5 item</td>
                            <td>Express</td>
                            <td><span class="badge bg-warning">Dicuci</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#orderDetail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#LS-2024002</td>
                            <td>Fatimah Azzahra</td>
                            <td>XI A</td>
                            <td>Ummar bin Khattab</td>
                            <td>4 item</td>
                            <td>Express</td>
                            <td><span class="badge bg-success">Siap Diambil</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#orderDetail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#LS-2024003</td>
                            <td>Muhammad Hasan</td>
                            <td>XI A</td>
                            <td>Ummar bin Khattab</td>
                            <td>6 item</td>
                            <td>Express</td>
                            <td><span class="badge bg-info">Baru</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#orderDetail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Order Detail Modal -->
    <div class="modal fade" id="orderDetail" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Cucian #LS-2024001</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informasi Santri</h6>
                            <p class="mb-1">Nama: Ahmad Faiz</p>
                            <p class="mb-1">NIS: 2024001</p>
                            <p class="mb-1">Asrama: XI A</p>
                            <p class="mb-1">Asrama: Ummar bin Khattab</p>
                            <p class="mb-1">Paket: Bulanan</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Cucian</h6>
                            <p class="mb-1">Tanggal Masuk: 16 Nov 2024</p>
                            <p class="mb-1">Estimasi Selesai: 17 Nov 2024</p>
                            <p class="mb-1">Status: <span class="badge bg-warning">Dicuci</span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.42.0/apexcharts.min.js"></script>

<script>
    // Asrama Chart
    var asramaOptions = {
        series: [{
            name: 'Total Cucian',
            data: [45, 52, 38, 45, 35, 42, 40, 38]
        }],
        chart: {
            type: 'bar',
            height: 300,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['A1', 'A2', 'A3', 'A4', 'B1', 'B2', 'B3', 'B4'],
        },
        colors: ['#0d6efd'],
        fill: {
            opacity: 0.8
        }
    };

    var asramaChart = new ApexCharts(document.querySelector("#asramaChart"), asramaOptions);
    asramaChart.render();

    // Status Chart
    var statusOptions = {
        series: [15, 25, 35, 25],
        chart: {
            type: 'donut',
            height: 300
        },
        labels: ['Baru', 'Dicuci', 'Disetrika', 'Siap Diambil'],
        colors: ['#0dcaf0', '#ffc107', '#6f42c1', '#198754'],
        legend: {
            position: 'bottom'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var statusChart = new ApexCharts(document.querySelector("#statusChart"), statusOptions);
    statusChart.render();
</script>
