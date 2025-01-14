<?php

namespace App\Livewire\Auth;

use App\Models\admin\Role;
use Detection\MobileDetect;
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

    public $is_mobile;

    public function mount()
    {
        $mobile = new MobileDetect();
        $this->is_mobile = $mobile->isMobile();
    }

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
            } else if ($result->nama === 'Guru Diniyyah') {
                return redirect()->route('e-santri-guru-diniyyah.dashboard');
            } else if ($result->nama === 'Guru Umum') {
                return redirect()->route('e-santri-guru-umum.dashboard');
            } else {
                return redirect()->route('santri.dashboard');
            }
        } else {
            $this->addError('credentials', 'Gagal masuk, email atau password salah!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirectRoute('/', navigate: true);
    }

    public function render()
    {
        if ($this->is_mobile) return view('livewire.mobile.auth.login-mobile')->layout('components.layouts.auth-mobile');
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}
