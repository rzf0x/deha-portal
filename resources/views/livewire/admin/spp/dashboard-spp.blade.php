<div>
    <div class="row">
        <h4 class="mb-3">Overview Pembayaran</h4>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri"
                iconClass="bi bi-people-fill" textColor="orange" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang belum bayar bulan ini" value="{{ $belum_bayar }}" subValue="Santri"
                iconClass="bi bi-info-circle-fill" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang sudah lunas bulan ini" value="{{ $lunas }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang cicilan bulan ini" value="{{ $cicilan }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="blue" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Tagihan Akan Jatuh Tempo" value="{{ $tagihanAkanJatuhTempo }}" subValue="hari"
                iconClass="bi bi-hourglass-split" textColor="yellow" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran" value="Rp" subValue="{{ $totalNominal }}"
                iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran Diterima" value="Rp"
                subValue="{{ $totalNominalDiterima }}" iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Belum Terbayar " value=" Rp"
                subValue="{{ $totalNominalTertunda }} {{ $totalNominalTertunda >= 0 ? 'lunas melebihi total' : '' }}" iconClass="bi bi-clock-history" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Persentase Nominal Pembayaran" value="{{ $persentasePembayaran }}" subValue="%"
                iconClass="bi bi-percent" textColor="purple" />
        </div>

        <div class="col-lg-3 col-12">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('dist/assets/static/images/faces/1.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->admin->role->nama }}</h5>
                            <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="row" wire:ignore>
        <div class="col-lg-8">
            <h4 class="mb-3">Overview Nominal Pembayaran</h4>
            <div id="pembayaranChart" class="card rounded-4 p-4 h-100 w-100"></div>
        </div>
        <div class="col-lg-4">
            <h4 class="mb-3">Overview Pembayaran Santri</h4>
            <div id="kelunasanSantriChart" class="card rounded-4 p-4 h-100 w-100"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var pembayaranChartOptions = {
        chart: {
            type: 'line',
            height: 350
        },
        series: [{ 
            name: 'total pembayaran',
            data: @json($monthlyTotals)
        }],
        xaxis: {
            categories: @json($bulanNames)
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
                endingShape: 'rounded'
            },
        },
        fill: {
            opacity: 1
        },
        colors: ['#FF6384', '#4BC0C0'],
        dataLabels: {
            enabled: false
        },
        yaxis: {
            title: {
                text: 'Jumlah Pembayaran'
            }
        },
        title: {
            text: 'Statistik Pembayaran tahun ini',
            align: 'left'
        }
    };

    var pembayaranChart = new ApexCharts(document.querySelector("#pembayaranChart"), pembayaranChartOptions);
    pembayaranChart.render();

    // Data untuk grafik pai (Kelunasan Santri)
    var kelunasanSantriChartOptions = {
        chart: {
            type: 'pie',
            height: 350
        },
        series: [{{ $belum_bayar }}, {{ $lunas }}, {{ $cicilan }}],
        labels: ['Belum Bayar', 'Sudah Lunas', 'Cicilan'],
        colors: ['#FF6384', '#4BC0C0', '#F3F527'],
        title: {
            text: 'Jumlah Santri Berdasarkan Kelunasan',
            align: 'left'
        }
    };

    var kelunasanSantriChart = new ApexCharts(document.querySelector("#kelunasanSantriChart"),
        kelunasanSantriChartOptions);
    kelunasanSantriChart.render();
</script>
