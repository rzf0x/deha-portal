<div id="auth-left" class="d-flex flex-column justify-content-center align-items-center h-100">
    <div class="text-center" style="max-width: 600px;">
        <a href="/" class="d-block mb-4">
            <img src="{{ asset('logo.webp') }}" alt="Logo" style="max-width: 6rem;">
        </a>

        <h1 class="title text-dark">Selamat datang di Deha Portal</h1>
        <p class="subtitle text-dark mb-5">Login menggunakan NISN & password yang benar 👋</p>

        <form wire:submit.prevent='login'>
            <div class="form-group position-relative has-icon-left mb-3">
                <input required type="email" wire:model='email' class="form-control form-control-lg"
                    placeholder="Email">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div x-data="{ show: false }" class="form-group position-relative has-icon-left mb-3">
                <input required :type="show ? 'text' : 'password'" class="form-control form-control-lg"
                    placeholder="Password" wire:model='password'>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div class="form-control-icon" style="left:auto; right:0; cursor: pointer;" @click="show = !show">
                    <i :class="!show ? 'bi-eye-slash' : 'bi-eye'"></i>
                </div>
                @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            @error('error')
                <div class="alert alert-danger mt-3 text-center">
                    Login gagal, password atau email salah.
                </div>
            @enderror

            <button type="submit" class="btn btn-primary btn-block mt-3 btn-md shadow-lg">
                Masuk <span wire:loading.class="spinner-border spinner-border-sm"></span>
            </button>
            <a href="{{ route('login-santri') }}" class="mt-3 btn btn-outline-primary btn-md w-100">Masuk Sebagai
                Santri</a>
        </form>

        {{-- <div class="text-center mt-5 text-lg fs-6">
            <p class="text-gray-600">Kamu belum punya akun? <a href="{{ route('register') }}"
                    class="font-bold text-primary">Daftar dulu</a></p>
        </div> --}}
    </div>
</div>
