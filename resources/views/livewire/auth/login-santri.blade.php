<div id="auth-left">
    <a href="#" class="mb-4">
        <img src="{{ asset('logo.webp') }}" alt="Logo" class="w-25">
    </a>
    <h1 class="auth-title mt-5">Selamat datang di Deha Portal</h1>
    <p class="auth-subtitle mb-5 pe-5">
        Login menggunakan NISN & password yang benar 👋
    </p>

    <form wire:submit='login'>
        <div class="form-group position-relative has-icon-left mb-4">
            <input required type="text" wire:model='nisn' class="form-control form-control-xl"
                placeholder="Masukkan NISN">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>

            @if ($errors->has('nisn'))
                <span class="text-danger mt-2">{{ $errors->first('nisn') }}</span>
            @endif

        </div>
        <div x-data="{ show: false }" class="form-group position-relative has-icon-left mb-3">
            <input required :type="show ? 'text' : 'password'" class="form-control form-control-xl"
                placeholder="Password" wire:model='password'>
            <div class="form-control-icon" style="cursor: pointer;">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div class="form-control-icon" style="left:auto; right:0; cursor: pointer;" @click="show = !show">
                <i :class="!show ? 'bi-eye-slash' : 'bi-eye'"></i>
            </div>
            @if ($errors->has('password'))
                <span class="text-danger mt-2">{{ $errors->first('password') }}</span>
            @endif
        </div>

        @error('error')
            <div class="text-center text-danger">
                login gagal, password atau nisn salah
            </div>
        @enderror
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">
            Log in <span wire:loading.class="spinner-border spinner-border-sm"></span>
        </button>
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 mt-2">Masuk Sebagai
            Administrator</a>
        {{-- <p class="m-0 text-dark text-xl text-center mt-5">Belum punya akun? Sini <a href="{{ route('register') }}"
            class="text-primary fw-bold text-decoration-underline">Daftar dulu</a></p> --}}
    </form>
</div>
