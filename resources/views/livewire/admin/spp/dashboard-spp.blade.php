<div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri" iconClass="bi bi-people-fill" textColor="orange" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang belum lunas bulan ini" value="{{ $belum_lunas }}" subValue="Santri" iconClass="bi bi-info-circle-fill" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang sudah lunas" value="{{ $lunas }}" subValue="Santri" iconClass="bi bi-circle-fill" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang cicilan" value="{{ $cicilan }}" subValue="Santri" iconClass="bi bi-circle-fill" textColor="blue" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Persentase Kelunasan Santri" value="{{ $persentaseKelunasan }}" subValue="%" iconClass="bi bi-percent" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Tagihan Akan Jatuh Tempo" value="{{ $tagihanAkanJatuhTempo }}" subValue="hari" iconClass="bi bi-hourglass-split" textColor="yellow" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Pembayaran Bulan Sebelumnya Yang Belum Tuntas" value="{{ $bulanBelumTuntas }}" subValue="Bulan" iconClass="bi bi-hourglass-split" textColor="yellow" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran" value="{{ $totalNominal }}" subValue="Rp" iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran Diterima" value="{{ $totalNominalDiterima }}" subValue="Rp" iconClass="bi bi-cash-stack" textColor="green" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Total Nominal Pembayaran Tertunda" value="- {{ $totalNominalTertunda }}" subValue="Rp" iconClass="bi bi-clock-history" textColor="red" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Rata-rata Pembayaran Per Santri" value="{{ $rataRataPembayaran }}" subValue="Rp" iconClass="bi bi-calculator" textColor="purple" />
        </div>
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Persentase Pembayaran" value="{{ $persentasePembayaran }}" subValue="%" iconClass="bi bi-percent" textColor="purple" />
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
        <div class="col-lg-12 col-12 w-50">
            <canvas id="santriChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('santriChart').getContext('2d');
    var santriChart = new Chart(ctx, {
        type: 'bar', // Bisa juga 'line', 'pie', dll.
        data: {
            labels: ['Belum Lunas', 'Sudah Lunas', 'Cicilan'],
            datasets: [{
                label: 'Jumlah Santri',
                data: [{{ $belum_lunas }}, {{ $lunas }}, {{ $cicilan }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Warna untuk Belum Lunas
                    'rgba(75, 192, 192, 0.2)', // Warna untuk Sudah Lunas
                    'rgba(54, 162, 235, 0.2)'  // Warna untuk Cicilan
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
