<div class="container-fluid p-4">
    <!-- Metrics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">Total Paket Aktif</div>
                            <div class="h3 mb-0">250</div>
                            <div class="text-success small mt-1">
                                Paket Bulanan Santri
                            </div>
                        </div>
                        <div class="icon-circle bg-primary bg-opacity-10">
                            <i class="fas fa-box-archive text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">Cucian Hari Ini</div>
                            <div class="h3 mb-0">45</div>
                            <div class="text-success small mt-1">
                                <i class="fas fa-arrow-up me-1"></i>15 belum diproses
                            </div>
                        </div>
                        <div class="icon-circle bg-success bg-opacity-10">
                            <i class="fas fa-tshirt text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">Total Asrama</div>
                            <div class="h3 mb-0">8</div>
                            <div class="text-warning small mt-1">
                                4 Putra | 4 Putri
                            </div>
                        </div>
                        <div class="icon-circle bg-warning bg-opacity-10">
                            <i class="fas fa-building text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small mb-1">Pembayaran Pending</div>
                            <div class="h3 mb-0">12</div>
                            <div class="text-danger small mt-1">
                                Belum Lunas Bulan Ini
                            </div>
                        </div>
                        <div class="icon-circle bg-danger bg-opacity-10">
                            <i class="fas fa-money-bill text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="card border-0">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">Statistik Cucian per Asrama</h5>
                </div>
                <div class="card-body">
                    <div id="asramaChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">Status Cucian Hari Ini</h5>
                </div>
                <div class="card-body">
                    <div id="statusChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0">
        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Cucian Aktif</h5>
            <div>
                <select class="form-select form-select-sm" style="width: 200px;">
                    <option value="">Semua Asrama</option>
                    <option>Asrama A1 (Putra)</option>
                    <option>Asrama A2 (Putra)</option>
                    <option>Asrama B1 (Putri)</option>
                    <option>Asrama B2 (Putri)</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Cucian</th>
                            <th>Nama Santri</th>
                            <th>Asrama/Kamar</th>
                            <th>Jumlah Item</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#LS-2024001</td>
                            <td>Ahmad Faiz</td>
                            <td>A1/Kamar 12</td>
                            <td>5 item</td>
                            <td><span class="badge bg-warning">Dicuci</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#LS-2024002</td>
                            <td>Fatimah Azzahra</td>
                            <td>B1/Kamar 05</td>
                            <td>4 item</td>
                            <td><span class="badge bg-success">Siap Diambil</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#LS-2024003</td>
                            <td>Muhammad Hasan</td>
                            <td>A2/Kamar 08</td>
                            <td>6 item</td>
                            <td><span class="badge bg-info">Baru</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                        <p class="mb-1">Asrama: A1/Kamar 12</p>
                        <p class="mb-1">Paket: Bulanan</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Cucian</h6>
                        <p class="mb-1">Tanggal Masuk: 16 Nov 2024</p>
                        <p class="mb-1">Estimasi Selesai: 17 Nov 2024</p>
                        <p class="mb-1">Status: <span class="badge bg-warning">Dicuci</span></p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Baju Putih</td>
                                <td>2</td>
                                <td>Seragam Sekolah</td>
                            </tr>
                            <tr>
                                <td>Celana</td>
                                <td>2</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Sarung</td>
                                <td>1</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Update Status</button>
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