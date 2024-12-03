<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PengumumanForm extends Form
{
    #[Validate('required')]
    public $judul;
    #[Validate('required')]
    public $isi_pengumuman;
    #[Validate('required')]
    public $tanggal;
}
