<?php

namespace App\Livewire\Auth;

use App\Models\admin\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    // #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    #[Title('Halaman Login')]

    public function login()
    {
        $this->validate();
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $data = $user->roles_id;

            $result = Role::where('id', $data)->first();

            // Simpan data ke dalam sesi
            session(['role' => $result->nama]);


            if ($result->nama === 'Super Admin') {
                return redirect()->route('admin.dashboard');
            } else if ($result->nama === 'Petugas SPP') {
                return redirect()->route('spp.dashboard');
            } else if ($result->nama === 'Petugas E-Cashless') {
                return redirect()->route('petugas-e-cashless.dashboard');
            } else if ($result->nama === 'Petugas Warung') {
                return redirect()->route('petugas-warung.dashboard');
            } else if ($result->nama === 'Petugas Laundry') {
                return redirect()->route('petugas-laundry.dashboard');
            } else {
                return redirect()->route('santri.dashboard');
            }
        }
        else{
            $this->addError('error', 'Invalid credentials!');
        }

    }

    public function logout()
    {
        Auth::logout();
        return $this->redirectRoute('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}
