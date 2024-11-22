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
        'email.min' => 'Masukkan email',
        'password.required' => 'Minimal 8 karakter',
        'password.min' => 'Minimal 8 karakter',
    ];
}
