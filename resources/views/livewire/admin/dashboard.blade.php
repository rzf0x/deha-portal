<section>
    <div class="row">
        <div class="col-lg-2">
            <x-card.card-basic title="Total Jenjang" value="{{ $totalJenjang }}" subValue="Jenjang"
                iconClass="bi bi-circle-fill" textColor="purple" />
        </div>

        <div class="col-lg-2">
            <x-card.card-basic title="Total Kelas" value="{{ $totalKelas }}" subValue="Kelas"
                iconClass="bi bi-house-door-fill" textColor="purple" />
        </div>

        <div class="col-lg-2">
            <x-card.card-basic title="Total Kamar" value="{{ $totalKamar }}" subValue="Kamar"
                iconClass="bi bi-usb-mini-fill" textColor="purple" />
        </div>

        <div class="col-lg-2">
            <x-card.card-basic title="Total Admin" value="{{ $totalAdmin }}" subValue="Admin"
                iconClass="bi bi-person-fill-gear" textColor="purple" />
        </div>

        <div class="col-lg-2">
            <x-card.card-basic title="Total Santri" value="{{ $totalSantri }}" subValue="Santri"
                iconClass="bi bi-people-fill" textColor="purple" />
        </div>
    </div>


</section>
