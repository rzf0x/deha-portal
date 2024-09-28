<div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang belum lunas bulan ini" value="{{ $lunas }}" subValue="Santri" iconClass="bi bi-info-circle-fill" textColor="red" />
        </div>

        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang sudah lunas" value="{{ $belum_lunas }}" subValue="Santri" iconClass="bi bi-circle-fill" textColor="green" />
        </div>

        <div class="col-lg-3 col-12">
            <x-card.card-basic title="Santri yang cicilan" value="{{ $cicilan }}" subValue="Santri" iconClass="bi bi-circle-fill" textColor="blue" />
        </div>

        <div class="col-lg-3 col-12">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('dist/assets/static/images/faces/1.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">
                                {{ Auth::user()->admin->role->nama }}
                            </h5>
                            <h6 class="text-muted mb-0">
                                {{ Auth::user()->email }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
