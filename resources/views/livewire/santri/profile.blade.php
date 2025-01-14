<div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Data Pribadi</h3>
                        <button class="btn btn-dark" wire:click='edit("{{  auth()->user()->id }}")' data-bs-target='#santriProfile'
                            data-bs-toggle="modal">
                            Edit Profile
                        </button>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-2 ">Nama Lengkap</h6>
                        <p class="fw-medium">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Email</h6>
                        <p class="fw-medium">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Password</h6>
                        <p class="fw-medium">{{ auth()->user()->password }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Jenjang</h6>
                        <p class="fw-medium">{{ $profile?->kelas->jenjang->nama  ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Kelas</h6>
                        <p class="fw-medium">{{ $profile?->kelas->nama  ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Kamar</h6>
                        <p class="fw-medium">{{ $profile?->kamar->nama  ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 ">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Informasi Lainnya</h3>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-2 ">Jenis Kelamin</h6>
                        <p class="fw-medium">{{ $profile?->jenis_kelamin == 'putera' ? 'laki-laki' : 'perempuan'  ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">Tempat/Tanggal Lahir</h6>
                        <p class="fw-medium">{{ $profile?->tempat_lahir  ?? '-' }},
                            {{ \Carbon\Carbon::parse($profile?->tanggal_lahir)->format('d M Y') }}
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2">Aktifitas Pendidikan</h6>
                        <p class="fw-medium badge m-0 bg-primary">{{ $profile?->aktivitas_pendidikan ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2">NISN</h6>
                        <p class="fw-medium">{{ $profile?->nisn ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">NISM</h6>
                        <p class="fw-medium">{{ $profile?->nism ?? '-' }}</p>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-2 ">NPSN</h6>
                        <p class="fw-medium">{{ $profile?->npsn ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="santriProfile" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Update Profile</h5>
                    <button type="button" wire:click='close' class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent='updateProfileSantri'>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="email" class="form-label text-dark">Email</label>
                            <input type="text" class="form-control" id="email" wire:model.live="userForm.email"
                                placeholder="Email" required>
                            @error('userForm.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label text-dark">Password</label>
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
                        <button type="button" wire:click='close' class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
