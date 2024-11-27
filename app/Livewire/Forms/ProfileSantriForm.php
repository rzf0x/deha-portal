<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileSantriForm extends Form
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    protected $messages = [
        'email.required' => 'Masukkan email',
        'email.email' => 'Format email tidak sesuai',
        'password.required' => 'Minimal 8 karakter',
        'password.min' => 'Minimal 8 karakter',
    ];
}
