<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
    //String
    public $email, $username, $password;
    //Boolean
    public $isSubmitActive = false;

    protected $rules = [
        'email' => 'min:8|max:16',
        'username' => 'min:4|max:100',
        'password' => 'min:6',
    ];

    protected $messages = [
        'email.min' => 'Minimal 8 huruf',
        'email.max' => 'Maksimal 16 huruf',
        'username.min' => 'Minimal 6 huruf',
        'username.max' => 'Minimal 16 huruf',
        'password.min' => 'Minimal 6 karakter',
    ];

    public function isFormFilled()
    {
        if (!empty($this->email) && !empty($this->username) && !empty($this->password)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    public function updated($property)
    {
        $this->isFormFilled();

        if ($property == 'email') {
            $this->validateOnly('email');
        }

        // if ($property == 'username') {
        //     $this->validateOnly('username');
        // }

        if ($property == 'password') {
            $this->validateOnly('password');
        }
    }

    public function register()
    {
        return dd($this->email, $this->username, $this->password);
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.auth');
    }
}
