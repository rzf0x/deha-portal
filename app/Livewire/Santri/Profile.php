<?php

namespace App\Livewire\Santri;

use App\Livewire\Forms\ProfileSantriForm;
use App\Models\Santri;
use App\Models\User;
use Detection\MobileDetect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{
    #[Title('Profile Santri')]
    public $profile;
    public $showPassword, $userId, $isMobile;
    public ProfileSantriForm $userForm;

    public function mount()
    {
        $this->profile = Santri::with('kamar', 'kelas', 'semester', 'angkatan')->where('nama', auth()->user()->name)->first();
        $mobile = new MobileDetect();
        $this->isMobile = $mobile->isMobile();
    }

    public function edit($id)
    {
        $this->userId = $id;
        $userEdit = User::findOrFail($id);
        $this->userForm->fill($userEdit);
    }

    public function close()
    {
        $this->userForm->reset();
    }

    public function updateProfileSantri()
    {
        $this->userForm->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ]);

        try {
            if ($this->userForm->password) {
                User::findOrFail($this->userId)->update([
                    'password' => Hash::make($this->userForm->password),
                ]);
            }

            User::findOrFail($this->userId)->update([
                'email' => $this->userForm->email,
            ]);

            return to_route('santri.profile');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        if ($this->isMobile) return view('livewire.mobile.santri.profile')->layout('components.layouts.app-mobile');
        return view('livewire.santri.profile');
    }
}
