<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class JadwalPelajaranForm extends Form
{
    //
    #[Validate('required|exists:kelas,id')]
    public $kelas_id;
    #[Validate('required|exists:kategori_pelajaran,id')]
    public $kategori_pelajaran_id;
    #[Validate('required')]
    public $mata_pelajaran;
    #[Validate('required')]
    public $waktu_mulai;
    #[Validate('required')]
    public $waktu_selesai;
    #[Validate('required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu')]
    public $hari;
    #[Validate('required|in:diniyyah,umum')]
    public $role_guru;
}
