<div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri"
                iconClass="bi bi-people-fill" textColor="orange" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang belum bayar bulan ini" value="{{ $belum_bayar }}" subValue="Santri"
                iconClass="bi bi-info-circle-fill" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang sudah lunas" value="{{ $lunas }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang cicilan" value="{{ $cicilan }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="blue" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Tagihan Akan Jatuh Tempo" value="{{ $tagihanAkanJatuhTempo }}" subValue="hari"
                iconClass="bi bi-hourglass-split" textColor="yellow" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran" value="{{ $totalNominal }}" subValue="Rp"
                iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran Diterima" value="{{ $totalNominalDiterima }}"
                subValue="Rp" iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran Tertunda" value=" {{ $totalNominalTertunda }}"
                subValue="Rp" iconClass="bi bi-clock-history" textColor="red" />
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
            <h4 class="mb-3">Overview Pembayaran</h4>
            <div id="pembayaranChart" class="card rounded-4 p-4 h-100 w-100"></div>
        </div>
        <div class="col-lg-4">
            <h4 class="mb-3">Overview Kelunasan</h4>
            <div id="kelunasanSantriChart" class="card rounded-4 p-4 h-100 w-100"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // Data untuk grafik batang (Pembayaran Harian)
    const labels = @json($pembayaranHarian->pluck('tanggal'));
    const data = @json($pembayaranHarian->pluck('total'));

    var pembayaranChartOptions = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Statistik Pembayaran di Bulan Ini',
            data: data
        }],
        xaxis: {
            categories: labels
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
            text: 'Statistik Pembayaran Bulanan',
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
