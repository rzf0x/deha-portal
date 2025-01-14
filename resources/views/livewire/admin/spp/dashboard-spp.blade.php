<div>
    <div class="form-group sticky-top bg-white p-3 shadow-sm" style="top: 1rem; z-index: 99;">
        <div class="d-flex gap-3">
            <select wire:model.live="filter.jenjang" wire:change='generateData' wire:loading.attr="disabled"
                class="form-select">
                @foreach ($jenjangOptions as $jenjang)
                    <option value="{{ $jenjang->nama }}">{{ $jenjang->nama }} </option>
                @endforeach
            </select>
            <select wire:model.live="filter.tahun" wire:change='generateData' wire:loading.attr="disabled"
                class="form-select">
                @foreach ($tahunOptions as $tahun)
                    <option value="{{ $tahun->nama_tahun }}">{{ $tahun->nama_tahun }} </option>
                @endforeach
            </select>
            <select wire:model.live="filter.bulan" wire:change='generateData' wire:loading.attr="disabled"
                class="form-select">
                @foreach ($bulanOptions as $bulan)
                    <option value="{{ $bulan }}">{{ $bulan }} </option>
                @endforeach
            </select>
        </div>
        <span wire:target='filter.jenjang' wire:loading.class.remove='d-none'
            class="d-none spinner-border spinner-border-sm absolute-right"></span>
    </div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri"
                iconClass="bi bi-people-fill" textColor="orange" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri belum bayar" value="{{ $belum_bayar }}" subValue="Santri"
                iconClass="bi bi-info-circle-fill" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri sudah lunas" value="{{ $lunas }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri cicilan" value="{{ $cicilan }}" subValue="Santri"
                iconClass="bi bi-circle-fill" textColor="blue" />
        </div>


        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran" value="Rp" subValue="{{ $totalNominal }}"
                iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Diterima" value="Rp" subValue="{{ $totalNominalDiterima }}"
                iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Belum Diterima" value=" Rp"
                subValue="{{ $totalNominalTertunda }} {{ $totalNominalTertunda > 0 ? 'lunas melebihi total' : '' }}"
                iconClass="bi bi-clock-history" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Akan Jatuh Tempo" value="{{ $tagihanAkanJatuhTempo }}" subValue="hari"
                iconClass="bi bi-hourglass-split" textColor="yellow" />
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Overview Pembayaran {{ $filter['tahun'] }} {{ $filter['jenjang'] }}</h4>
                </div>
                <div wire:ignore class="card-body" style="position: relative;">
                    <div id="pembayaranChart" style="min-height: 365px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Overview Pembayaran {{ $filter['bulan'] }}</h4>
                </div>
                <div wire:ignore class="card-body" style="position: relative;">
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
        xaxis: {
            categories: @json($bulanOptions)
        },
        yaxis: {
            min: 0,
            title: {
                text: 'Jumlah Pembayaran'
            }
        },
        tooltip: {
            y: {
                formatter: val => "Rp " + val.toLocaleString('id-ID')
            }
        }
    };

    var donutOptions = {
        series: [{{ $belum_bayar }}, {{ $lunas }}, {{ $cicilan }}],
        chart: {
            type: 'donut',
            height: '100%',
            events: {
                mounted: function(chartContext, config) {
                    checkEmptyData(chartContext);
                },
                updated: function(chartContext, config) {
                    checkEmptyData(chartContext);
                }
            }
        },
        legend: {
            position: 'bottom',
            fontSize: '14px',
        },
        labels: ['Belum Bayar', 'Sudah Lunas', 'Cicilan'],
        colors: ['#ff6384', '#36a2eb', '#ffce56'],
        tooltip: {
            y: {
                formatter: val => val + " Santri"
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#pembayaranChart"), options);
    var donutChart = new ApexCharts(document.querySelector("#kelunasanSantriChart"), donutOptions);

    chart.render();
    donutChart.render();

    // Status untuk melacak apakah anotasi "Santri Kosong" sudah diterapkan
    var isEmptyDataDisplayed = false;

    // Fungsi untuk mengecek apakah data di chart donut kosong
    function checkEmptyData(chartContext) {
        const isEmpty = donutOptions.series.every(value => value === 0);

        // Hanya perbarui anotasi jika status isEmpty berubah
        if (isEmpty && !isEmptyDataDisplayed) {
            chartContext.updateOptions({
                annotations: {
                    position: 'front',
                    texts: [{
                        text: 'Santri Kosong',
                        x: '50%',
                        y: '50%',
                        textAnchor: 'middle',
                        style: {
                            fontSize: '20px',
                            fontFamily: 'Arial',
                            color: '#999'
                        }
                    }]
                }
            });
            isEmptyDataDisplayed = true; // Tandai bahwa anotasi telah diterapkan
        } else if (!isEmpty && isEmptyDataDisplayed) {
            chartContext.updateOptions({
                annotations: {
                    texts: []
                }
            });
            isEmptyDataDisplayed = false; // Hapus tanda jika ada data
        }
    }

    // Mendengarkan event 'updateCharts' dari Livewire
    document.addEventListener('updateCharts', event => {
        const data = event.detail[0];

        // Update data chart area
        chart.updateSeries([{
            name: 'Total Pembayaran',
            data: data.monthlyTotals
        }]);

        // Update data chart donut dan cek apakah datanya kosong
        donutChart.updateSeries([data.belum_bayar, data.lunas, data.cicilan]);

        // Perbarui nilai donutOptions.series sesuai data terbaru
        donutOptions.series = [data.belum_bayar, data.lunas, data.cicilan];
        checkEmptyData(donutChart);
    });
</script>
