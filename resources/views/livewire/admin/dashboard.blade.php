<section>
    <div class="row">
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

        <div class="col-lg-3">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri"
                iconClass="bi bi-people-fill" textColor="purple" />
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
                            <th>Kelas</th>
                            <th>Kamar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ppp</td>
                            <td>ppp</td>
                            <td>ppp</td>
                            <td>ppp</td>
                            <td>ppp</td>
                            <td>ppp</td>
                        </tr>
                    </tbody>
                </table>
                {{-- {{ $this->getData->links() }} --}}
            </div>
        </div>
    </div>
</section>
