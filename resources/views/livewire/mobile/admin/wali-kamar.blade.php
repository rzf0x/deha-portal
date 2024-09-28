<div class="overflow-hidden mt-4">

    <div class="card p-3">
        <a href="/admin/dashboard">
            <i class="bi bi-arrow-left fs-6"></i>
        </a>
    </div>

    <h3 class="mb-4" style="margin-top: -10px;">List Wali Kamar</h3>

    <div class="row">
        @forelse ($this->listWaliKamar as $item)
            <div class="col-12">
                <div class="card text-center">
                    <!-- Background image -->
                    <img src="https://i.imgur.com/Qtrsrk5.jpg"class="card-img-top" alt="Background Image"
                       style="height: 100px; object-fit: cover; border-top-left-radius: calc(.25rem - 1px); border-top-right-radius: calc(.25rem - 1px);">

                    <!-- Profile image (absolute position) -->
                    <div class="card-body" style="margin-top: -50px;">
                        <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}"
                            class="rounded-circle border border-white" alt="Profile Image"
                            style="width: 100px; height: 100px;">

                        <!-- Name and Location -->
                        <h5 class="card-title mt-3">{{ $item->nama }}</h5>
                        <p class="text-muted fs-5">{{ $item->alamat }}</p>

                        <div class="d-flex justify-content-between">
                            <div class="flex justify-content-center flex-column">
                                <span class="d-block" style="font-size: 14px !important;">Status Wali Kamar</span>
                                <span class="d-block text-info fw-bold mt-1">{{ $item->role }}</span>
                            </div>
                            <div class="flex justify-content-center flex-column">
                                <span class="d-block" style="font-size: 14px !important;">No Whatsapp</span>
                                <span class="d-block text-info fw-bold mt-1">{{ $item->no_whatsapp }}</span>
                            </div>
                        </div>
                    </div>
                </div>
</div>
            @empty
        @endforelse
    </div>
</div>
