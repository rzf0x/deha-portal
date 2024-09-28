<?php

namespace App\Livewire\Admin;

use App\Models\admin\Role;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class ListRole extends Component
{
    #[Title('Halaman Tambah Role Admin')]

    // String
    public $nama;
    // Number
    public $roleId;
    // Bool
    public $isEdit = false;

    #[Computed]
    public function listRole()
    {
        return Role::paginate();
    }

    public function create()
    {
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->nama = $role->nama;
        $this->isEdit = true;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
        ]);

        Role::updateOrCreate(['id' => $this->roleId], ['nama' => $this->nama]);

        session()->flash('message', $this->roleId ? 'Role Updated Successfully.' : 'Role Created Successfully.');

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->roleId = null;
        $this->isEdit = false;
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', 'Role Deleted Successfully.');
    }

    public function render()
    {
        return view('livewire.admin.list-role');
    }
}
