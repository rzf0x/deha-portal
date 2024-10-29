<section>
    <div class="row">
        <div class="col-lg-3">
            <x-card.card-basic title="Admin" value="{{ auth()->user()->email }}" subValue=""
                iconClass="bi bi-circle-fill" textColor="purple" />
        </div>

        <div class="col-lg-3">
            <x-card.card-basic title="Total Wali Kamar" value="{{ $waliKamar }}" subValue="Wali Kamar"
                iconClass="bi bi-circle-fill" textColor="purple" />
        </div>

        <div class="col-lg-3">
            <x-card.card-basic title="Total Kamar" value="{{ $totalKamar }}" subValue="Kamar"
                iconClass="bi bi-house-door-fill" textColor="purple" />
        </div>

        <div class="col-lg-3">
            <x-card.card-basic title="Total Wali Kelas" value="{{ $waliKelas }}" subValue="Wali Kelas"
                iconClass="bi bi-usb-mini-fill" textColor="purple" />
        </div>
    </div>
    <div style="gap: 5rem;" class="d-flex flex-column">
        <div class="row" wire:ignore>
            <div class="col-lg-8">
                <h4 class="mb-3">Overview Total Santri</h4>
                <div id="santriChart" class="card rounded-4 p-4 h-100 w-100"></div>
            </div>
            <div class="col-lg-4">
                <h4 class="mb-3">Total Semesteran</h4>
                <div id="waliChart" class="card rounded-4 p-4 h-100 w-100"></div>
            </div>
        </div>

        <div class="table-santri">
            <div class="d-flex justify-content-between">
                <h4 class="mb-3">Tabel Santri</h4>
                <a style="text-decoration: underline;" class="text-dark" wire:navigate
                    href="{{ route('admin.master-santri.santri') }}">Lihat semua santri</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenjang</th>
                                    <th>Angkatan</th>
                                    <th>Kamar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($santri as $santri)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($santri->foto)
                                                <img src="{{ Storage::url('images/santri/' . basename($santri->foto)) }}"
                                                    class=""
                                                    style="width: 4rem; height: 4rem; border-radius: 50%; object-fit: cover; background-size: cover;"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}"
                                                    class=""
                                                    style="width: 4rem; height: 4rem; border-radius: 50%; object-fit: cover;"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>{{ $santri->nama }}</td>
                                        <td>{{ $santri->kelas->nama }}</td>
                                        <td>{{ $santri->kelas->jenjang->nama }}</td>
                                        <td>{{ $santri->angkatan->nama ?? 'Null' }}</td>
                                        <td>{{ $santri->kamar->nama }}</td>
                                        <td><a href="{{ route('admin.master-santri.detail-santri', ['id' => $santri->nism]) }}"
                                                wire:navigate>
                                                <button class="btn btn-sm btn-primary text-white">
                                                    <i class="bi bi-eye-fill"></i> Detail
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.1/dist/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Bar Chart (Santri Chart)
    var santriOptions = {
        series: [{
            name: 'Laki-laki',
            data: @json($kelasSantriTotalPutra)
        }, {
            name: 'Perempuan',
            data: @json($kelasSantriTotalPutri)
        }],
        chart: {
            type: 'bar',
            height: 400,
            stacked: false,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#1c1dab', '#e893c5'],
        xaxis: {
            categories: @json($kelas),
        },
        yaxis: {
            min: 0,
            max: 20,
            tickAmount: 10,
        },
        legend: {
            position: 'top',
            fontSize: '14px',
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

    var santriChart = new ApexCharts(document.querySelector("#santriChart"), santriOptions);
    santriChart.render();

    var xValues = ["Total Jenjang", "Total Semester", "Total Kelas"];
    var yValues = [@json($totalJenjang), @json($totalSemester), @json($waliKamar)];
    // Pie Chart (Wali Chart)
    var waliOptions = {
        series: yValues,
        chart: {
            type: 'pie',
            height: 400
        },
        labels: xValues,
        colors: ['#f7b7a3', '#57167e', '#fff1a4'],
        legend: {
            position: 'bottom',
            fontSize: '14px',
        },
        title: {
            text: 'Jumlah Semesteran',
            align: 'center',
            style: {
                fontSize: '16px'
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 280
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var waliChart = new ApexCharts(document.querySelector("#waliChart"), waliOptions);
    waliChart.render();
</script>
