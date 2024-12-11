<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class JadwalPiket extends Form
{
    //
    
    #[Validate('required|exists:santris,id')]
    public $santri_id;
    #[Validate('required|exists:kelas,id')]
    public $kelas_id;
    #[Validate('required|string')]
    public $keterangan;
    #[Validate('required|in:pagi,siang,sore,malam')]
    public $waktu;
    #[Validate('required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu')]
    public $hari;
    #[Validate('required|in:diniyyah,umum')]
    public $role_guru;
}
