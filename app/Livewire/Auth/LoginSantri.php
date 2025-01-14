<?php

namespace App\Livewire\Auth;

use App\Models\Santri;
use App\Models\User;
use Detection\MobileDetect;
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
        $santri = Santri::with('user')->where('nisn', $this->nisn)->where('nisn', $this->password)->first();
        dd($santri);
    }

    public function render()
    {
        if($this->is_mobile) return view('livewire.mobile.auth.login-mobile-santri')->layout('components.layouts.auth-mobile');
        return view('livewire.auth.login-santri')->layout('components.layouts.auth');
    }
}
