<div style="margin-bottom: 6rem" class="">
    <div class="bg-primary px-3 text-white d-flex justify-content-between align-items-center text-start py-4">
        <div class="">
            <h1 class="h4 text-white mb-1">Halo, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
            <p class="mb-0 text-white fw-light">{{ auth()->user()->email }}</p>
        </div>
        <i data-bs-toggle='modal' wire:click='edit("{{ auth()->user()->id }}")' data-bs-target="#santriProfile"
            class="bi text-white bi-pencil"></i>
    </div>
    <div class="px-3 my-4">
        <div class="">
            <button style="background-color: #fff6c0;" class="btn btn-sm fs-6 m-0 px-3 text-warning rounded-pill">Data
                Pribadi</button>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Nama lengkap</p>
            <h6 class="fw-bold text-dark">{{ auth()->user()->name }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Password</p>
            <h6 style="word-break: break-all; overflow-wrap: break-word; line-height: 1.5rem;" class="fw-bold  text-dark">{{ auth()->user()->password }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Jenjang</p>
            <h6 class="fw-bold text-dark">{{ $profile?->kelas->jenjang->nama  ?? '-' }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Kelas</p>
            <h6 class="fw-bold text-dark">{{ $profile?->kelas->nama  ?? '-' }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Kamar</p>
            <h6 class="fw-bold text-dark">{{ $profile?->kamar->nama  ?? '-' }}</h6>
        </div>
        <div class="mt-4">
            <button style="background-color: #CED5FF;" class="btn btn-sm fs-6 m-0 px-3 text-primary rounded-pill">Informasi
                Lainnya</button>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Jenis Kelamin</p>
            <h6 class="fw-bold text-dark">{{ $profile?->jenis_kelamin  ?? '-' }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Tempat / Tanggal Lahir</p>
            <h6 class="fw-bold text-dark">{{ $profile?->tempat_lahir  ?? '-' }},
                {{ \Carbon\Carbon::parse($profile?->tanggal_lahir)->format('d M Y') }} </h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">Aktifitas Pendidikan</p>
            <h6 class="fw-bold badge bg-primary">{{ $profile?->aktivitas_pendidikan  ?? '-' }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">NISN</p>
            <h6 class="fw-bold text-dark">{{ $profile?->nisn  ?? '-' }}</h6>
        </div>
        <div class="mt-3">
            <p class="text-secondary small mb-1">NISM</p>
            <h6 class="fw-bold text-dark">{{ $profile?->nism  ?? '-' }}</h6>
        </div>
        <div class="mt-3 ">
            <p class="text-secondary small mb-1">NPSN</p>
            <h6 class="fw-bold text-dark">{{ $profile?->npsn  ?? '-' }}</h6>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="santriProfile" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Update Profile</h6>
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
                                    id="password" wire:model.live="userForm.password" placeholder="Password" required>
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
