<div style="margin-bottom: 6rem" class="mt-3">
    <div class="top-bar px-3 justify-content-between d-flex align-items-center">
        <a href="{{ route('santri.dashboard') }}" class="arrow-back">
            <i class="bi text-dark fs-1 bi-arrow-left-circle"></i>
        </a>
        <h5 class="m-0">
            Profile
        </h5>
        <div data-bs-toggle='modal' wire:click='edit("{{ auth()->user()->id }}")' data-bs-target="#editProfile" data-bs
            class="arrow-back">
            <i class="bi text-dark fs-5 bi-pencil"></i>
        </div>
    </div>

    <div class="px-3 mt-3">
        <div style="min-width: 100%; min-height: 160px;" class="position-relative bg-secondary rounded-4">
            <div style="top: 7rem; z-index: 9;"
                class="profile position-absolute start-50 translate-middle-x d-flex flex-column align-items-center gap-1">
                <div class="position-relative" style="width: 90px; height: 90px;">
                    <img class="img-fluid rounded-circle"
                        src="{{ $profile?->foto ? Storage::url('images/santri/' . $profile?->foto) : 'https://a.storyblok.com/f/191576/1200x800/a3640fdc4c/profile_picture_maker_before.webp' }}"
                        alt="" style="object-fit: cover; width: 100%; height: 100%; border: 6px solid #FAFAFA">
                </div>
                <div class="text-center">
                    <h4 class="mb-0 text-dark fw-bold">{{ auth()->user()->name }}</h4>
                    <p class="m-0 mt-1"><span class="badge bg-primary">{{ $profile?->kelas->nama ?? '-' }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 8rem;" class="px-3">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h6 class="mb-2 small ">Email</h6>
                    <p class="fw-medium m-0">{{ auth()->user()->email ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small ">Password</h6>
                    <p class="fw-medium m-0">{{ auth()->user()->password ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small ">Jenjang</h6>
                    <p class="fw-medium m-0">{{ $profile?->kelas->jenjang->nama ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">Kamar</h6>
                    <p class="fw-medium m-0">{{ $profile?->kamar->nama ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">Jenis Kelamin</h6>
                    <p class="fw-medium m-0">
                        {{ $profile?->jenis_kelamin == 'putera' ? 'laki-laki' : 'perempuan' ?? '-' }}
                    </p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">Tempat/Tanggal Lahir</h6>
                    <p class="fw-medium m-0">{{ $profile?->tempat_lahir ?? '-' }},
                        {{ \Carbon\Carbon::parse($profile?->tanggal_lahir)->format('d M Y') }}
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">Aktifitas Pendidikan</h6>
                    <p class="fw-medium m-0 badge m-0 bg-primary">{{ $profile?->aktivitas_pendidikan ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">NISN</h6>
                    <p class="fw-medium m-0">{{ $profile?->nisn ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">NISM</h6>
                    <p class="fw-medium m-0">{{ $profile?->nism ?? '-' }}</p>
                </div>
                <div class="mt-3">
                    <h6 class="mb-2 small">NPSN</h6>
                    <p class="fw-medium m-0">{{ $profile?->npsn ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Profile</h5>
                    <button type="button" wire:click='close' class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent='updateProfileSantri'>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" wire:model.live="userForm.email"
                                placeholder="Email" required>
                            @error('userForm.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <div class="form-group position-relative">
                                <input type="{{ $showPassword ? 'text' : 'password' }}" class="form-control"
                                    id="password" wire:model.live="userForm.password" placeholder="Password">
                                <div wire:click="$toggle('showPassword')"
                                    class="form-control-icon me-2 position-absolute"
                                    style="left:auto; right:0; cursor: pointer;">
                                    <i class="bi {{ $showPassword ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                </div>
                            </div>
                            @error('userForm.password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click='close' class="btn btn-secondary"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
