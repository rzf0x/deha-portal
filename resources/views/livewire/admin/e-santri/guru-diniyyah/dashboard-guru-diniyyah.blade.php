<div class="container-fluid py-4">
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats ">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total guru diniyyah</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <h4 class="mb-0">{{ $totalGuruDiniyyah }} Guru</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats ">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Mata Pelajaran</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <h4 class="mb-0">{{ $totalMataPelajaran }} Pelajaran</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats ">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Kategori Pelajaran</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <h4 class="mb-0">{{ $totalKategoriPelajaran }} Kategori</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="card mb-0 card-stats">
                <div class="card-body">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-2">Total Pengumuman Mendatang</h6>
                        <h4 class="mb-0">{{ $totalPengumuman }} Pengumuman</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card mb-0 mb-4">
        <div class="card-header bg-transparent">
            <div class="row">
                <!-- Title -->
                <div class="col-12 col-md-9 d-flex align-items-center mb-2 mb-sm-0">
                    <h5 class="card-title fs-5 mb-0">Grafik Guru Diniyyah Maret 2024</h5>
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

    <div class="card">
        <div class="card-header">
            <div class="row">
                <ul class="nav nav-tabs card-header-tabs col-12 col-md-7 d-flex align-items-center mb-2 mb-md-0"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#jadwal-piket">Jadwal Piket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mata-pelajaran">Mata Pelajaran</a>
                    </li>
                </ul>
                <div
                    class="col-12 col-md-5 d-flex mt-md-0 mt-4 flex-column flex-md-row justify-content-md-end align-items-start align-items-md-center gap-2">

                    <select class="form-select" aria-label="Filter Kelas">
                        @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
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
                <!-- Jadwal Piket -->
                <div class="tab-pane fade show active" id="jadwal-piket">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Santri</th>
                                    <th>Kelas</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalPiket as $piket)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $piket->santri->nama ?? 'N/A' }}</td>
                                        <td>{{ $piket->kelas->nama ?? 'N/A' }}</td>
                                        <td>{{ $piket->keterangan }}</td>
                                        <td>{{ $piket->waktu }}</td>
                                        <td>{{ $piket->hari }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada jadwal piket</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mata Pelajaran -->
                <div class="tab-pane fade" id="mata-pelajaran">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th> Kelas</th>
                                    <th>Kategori</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalPelajaran as $pelajaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pelajaran->mata_pelajaran }}</td>
                                        <td>{{ $pelajaran->kelas->nama ?? 'N/A' }}</td>
                                        <td>{{ $pelajaran->kategoriPelajaran->nama ?? 'N/A' }}</td>
                                        <td>{{ $pelajaran->waktu_mulai }}</td>
                                        <td>{{ $pelajaran->waktu_selesai }}</td>
                                        <td>{{ $pelajaran->hari }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada mata pelajaran</td>
                                    </tr>
                                @endforelse
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
        labels: @json($labels),
        series: @json($series),
        colors: ['#4A90E2', '#50E3C2', '#F5A623'],
        chart: {
            type: 'donut',
            height: 350
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
            }
        }],
        legend: {
            position: 'top',
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val.toFixed(0);
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#transactionChart"), options);
    chart.render();
</script>
