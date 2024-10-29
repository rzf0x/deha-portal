<?php

namespace App\Livewire\Admin;

use App\Models\admin\Semester as AdminSemester;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Semester extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $semester_id, $nama;

    #[Url(except: "")]
    public $perPage = 5;

    public function updatedPerPage()
    {
        $this->resetPage(); 
    }

    #[Title('Halaman Semester')]

    public function create()
    {
        $this->semester_id = '';
        $this->nama = '';
    }

    public function edit($id)
    {
        $data = AdminSemester::find($id);
        $this->semester_id = $data->id;
        $this->nama = $data->nama;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
        ]);

        AdminSemester::updateOrCreate(['id' => $this->semester_id], [
            'nama' => $this->nama,
        ]);

        session()->flash('message', $this->semester_id ? 'Data jenjang berhasil di update' : 'Data jenjang berhasil di tambahkan');
        $this->create();
    }

    public function delete($id)
    {
        AdminSemester::find($id)->delete();
        session()->flash('message', 'Data jenjang berhasil di hapus');
    }

    public function render()
    {
        return view('livewire.admin.semester', [
            'listAngkatan' => AdminSemester::paginate($this->perPage),
        ]);
    }
}
