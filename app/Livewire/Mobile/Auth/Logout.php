<?php

namespace App\Livewire\Mobile\Auth;

use Detection\MobileDetect;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public $isMobile;

    public function mount()
    {
        $mobile = new MobileDetect();
        $this->isMobile = $mobile->isMobile();
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.mobile.auth.logout');
    }
}
