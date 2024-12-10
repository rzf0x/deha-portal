<?php
namespace App\Livewire\Forms;

use Livewire\Form;

class KategoriPelajaranForm extends Form
{
    public $nama;
    public $deskripsi;

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255|unique:kategori_pelajaran,nama',
            'deskripsi' => 'nullable|string|max:500'
        ];
    }
}