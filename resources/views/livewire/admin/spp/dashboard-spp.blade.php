<div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri"
                iconClass="bi bi-people-fill" textColor="orange" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri belum bayar bulan ini" value="{{ $belum_bayar }}" subValue="Santri"
                iconClass="bi bi-info-circle-fill" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri sudah lunas bulan ini" value="{{ $lunas }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri cicilan bulan ini" value="{{ $cicilan }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="blue" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran" value="Rp" subValue="{{ $totalNominal }}"
                iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Diterima" value="Rp"
                subValue="{{ $totalNominalDiterima }}" iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Belum Diterima" value=" Rp"
                subValue="{{ $totalNominalTertunda }} {{ $totalNominalTertunda > 0 ? 'lunas melebihi total' : '' }}"
                iconClass="bi bi-clock-history" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Persentase Nominal Pembayaran" value="{{ $persentasePembayaran }}" subValue="%"
                iconClass="bi bi-percent" textColor="purple" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Akan Jatuh Tempo" value="{{ $tagihanAkanJatuhTempo }}" subValue="hari"
                iconClass="bi bi-hourglass-split" textColor="yellow" />
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

    <div class="row mb-4">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Overview Nominal Pembayaran</h4>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="pembayaranChart" style="min-height: 365px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Overview Pembayaran Santri</h4>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="kelunasanSantriChart" style="min-height: 365px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<script>
    var options = {
        series: [{
            name: 'Total Pembayaran',
            data: @json($monthlyTotals)
        }],
        chart: {
            type: 'area',
            height: '100%',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: '60%',
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#4154f1'],
        xaxis: {
            categories: @json($bulanNames),
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            title: {
                text: 'Jumlah Pembayaran'
            }
        },
        grid: {
            borderColor: '#f1f1f1',
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "Rp " + val.toLocaleString('id-ID')
                }
            }
        }
    };

    var donutOptions = {
        series: [{{ $belum_bayar }}, {{ $lunas }}, {{ $cicilan }}],
        chart: {
            type: 'donut',
            height: '100%'
        },
        labels: ['Belum Bayar', 'Sudah Lunas', 'Cicilan'],
        colors: ['#ff6384', '#36a2eb', '#ffce56'],
        legend: {
            position: 'bottom'
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " Santri"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#pembayaranChart"), options);
    var donutChart = new ApexCharts(document.querySelector("#kelunasanSantriChart"), donutOptions);

    chart.render();
    donutChart.render();
</script>
