<?php

namespace App\Livewire\Auth;

use App\Models\Santri;
use App\Models\User;
use Detection\MobileDetect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginSantri extends Component
{
    #[Title('Halaman Login Santri')]

    #[Validate('required')]
    public $nisn;

    #[Validate('required')]
    public $password;

    public $is_mobile;

    public function mount()
    {
        $mobile = new MobileDetect();
        $this->is_mobile = $mobile->isMobile();
    }

    public function login()
    {
        $user = User::where('email', $this->nisn)->first();

        if (!$user) {
            $this->addError('nisn', 'NISN tidak ditemukan.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Password salah, pastikan password sama dengen NISN');
            return;
        }

        Auth::login($user);

        return to_route('santri.dashboard');
    }


    public function render()
    {
        if ($this->is_mobile) return view('livewire.mobile.auth.login-mobile-santri')->layout('components.layouts.auth-mobile');
        return view('livewire.auth.login-santri')->layout('components.layouts.auth');
    }
}
