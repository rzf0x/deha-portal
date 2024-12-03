<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class KegiatanForm extends Form
{
    #[Validate('required')]
    public $judul;

    #[Validate('required')]
    public $isi_kegiatan;

    #[Validate('required')]
    public $waktu_mulai;

    #[Validate('required')]
    public $waktu_selesai;
}
