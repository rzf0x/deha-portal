<div id="auth-left">
    <a href="#" class="mb-4">
        <img src="{{ asset('logo.webp') }}" alt="Logo" class="w-25">
    </a>
    <h1 class="auth-title mt-5">Selamat datang di Deha Portal</h1>
    <p class="auth-subtitle mb-5 pe-5">
        Login menggunakan email & password yang benar 👋
    </p>

    <form wire:submit='login'>
        <div class="form-group position-relative has-icon-left mb-4">
            <input required type="text" wire:model='email' class="form-control form-control-xl"
                placeholder="Email">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>

            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif

        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input required type="{{ $showPassword ? 'text' : 'password' }}" wire:model="password"
                class="form-control form-control-xl" placeholder="Password">
            <div class="form-control-icon" style="cursor: pointer;">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div class="form-control-icon" style="left:auto; right:0; cursor: pointer;"
                wire:click="$toggle('showPassword')">
                <i class="bi {{ $showPassword ? 'bi-eye-slash' : 'bi-eye' }}"></i>
            </div>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
            Log in <span wire:loading.class="spinner-border spinner-border-sm"></span>
        </button>
        @if (session()->has('error'))
            <div class="text-center text-danger">
                {{ session('error') }}
            </div>
        @endif
    </form>
</div>
