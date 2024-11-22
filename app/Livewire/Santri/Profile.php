<?php

namespace App\Livewire\Santri;

use App\Livewire\Forms\ProfileSantriForm;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{
    #[Title('Profile Santri')]
    public $profile;
    public $showPassword, $userId;
    public ProfileSantriForm $userForm;

    public function mount()
    {
        $this->profile = Santri::with('kamar', 'kelas', 'semester', 'angkatan')->where('nama', auth()->user()->name)->first();
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
        $this->userForm->validate();
        try {
            User::findOrFail($this->userId)->update([
                'email' => $this->userForm->email,
                'password' =>  Hash::make($this->userForm->password),
            ]);
            return to_route('santri.profile');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.santri.profile');
    }
}
