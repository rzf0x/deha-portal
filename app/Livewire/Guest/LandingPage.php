<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.guest.landing-page')->layout('components.layouts.guest');
    }
}
