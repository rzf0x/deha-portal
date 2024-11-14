<?php

namespace App\Livewire\Admin;

use App\Models\admin\Admin;
use App\Models\admin\Role;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ListAdmin extends Component
{
    use WithPagination;

    public $admin_id, $user_id, $roles_id;
    #[Title('Halaman List Admin')]

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    public function create()
    {
        $this->user_id = '';
        $this->roles_id = '';
    }

    public function edit($id)
    {
        $data = Admin::find($id);
        $this->user_id = $data->id;
        $this->roles_id = '';
    }

    #[Computed]
    public function listAdmin()
    {
        return Admin::paginate($this->perPage);
    }

    #[Computed]
    public function listRoleAdmin()
    {
        return Role::where('nama', '!=', 'Santri')->get();
    }

    public function render()
    {
        return view('livewire.admin.list-admin');
    }
}
