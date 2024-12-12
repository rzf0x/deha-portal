<?php
namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class KategoriPelajaranForm extends Form
{
    #[Validate('required|string|unique:kategori_pelajaran,nama')]
    public $nama;
    #[Validate('nullable|string')]
    public $deskripsi;
    #[Validate('required|in:diniyyah,umum')]
    public $role_guru;
}