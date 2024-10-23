<section>
    <div class="row">
        <div class="col-lg-3">
            <x-card.card-basic title="Admin" value="{{ auth()->user()->email }}" subValue=""
                iconClass="bi bi-circle-fill" textColor="purple" />
        </div>

        <div class="col-lg-3">
            <x-card.card-basic title="Total Kelas" value="{{ $totalKelas }}" subValue="Kelas"
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
    <div style="gap: 6rem;" class="d-flex flex-column">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-3">Overview Total Santri</h3>
                <canvas wire:ignore id="santriChart" class="bg-white rounded-4 p-4 w-100 h-100"></canvas>
            </div>
            <div class="col-lg-4">
                <h3 class="mb-3">Total Wali</h3>
                <canvas class="bg-white rounded-4 w-100 h-100"></canvas>
            </div>
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
                                <th>Angkatan</th>
                                <th>Kelas</th>
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
                                                class="img-fluid mx-auto"
                                                style="width: 4rem; height: 4rem; border-radius: 50%; object-fit: cover; background-size: cover;"
                                                alt="">
                                        @else
                                            <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}"
                                                class="img-fluid mx-auto"
                                                style="width: 4rem; height: 4rem; border-radius: 50%; object-fit: cover;"
                                                alt="">
                                        @endif
                                    </td>
                                    <td>{{ $santri->nama }}</td>
                                    <td>{{ $santri->angkatan?->nama }}</td>
                                    <td>{{ $santri->kelas->nama }}</td>
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
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    const xValues = @json($kelas);
    xValues.map(kelas => `${kelas} Laki-laki`);
    xValues.map(kelas => `${kelas} Perempuan`);

    new Chart("santriChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                    label: 'Laki-laki',
                    data: @json($kelasSantriTotalPutra),
                    backgroundColor: "#435ebe", 
                    borderColor: "#435ebe",
                    fill: false
                },
                {
                    label: 'Perempuan', 
                    data: @json($kelasSantriTotalPutri),
                    backgroundColor: "#E746BC", 
                    borderColor: "#E746BC",
                    fill: false
                }
            ]
        },
        options: {
            legend: {
                display: true, 
                labels: {
                    fontColor: "#333",
                    fontSize: 12
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0, 
                        max: 20, 
                        stepSize: 2 
                    }
                }]
            }
        }
    });
</script>

