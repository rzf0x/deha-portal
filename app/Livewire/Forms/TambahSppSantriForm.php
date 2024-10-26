<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TambahSppSantriForm extends Form
{
    //
    #[Validate('required')]
    public $santri_id = '';
    
    #[Validate('required')]
    public $pembayarah_tipe = '';

    #[Validate('required')]
    public $pembayaran_timeline_id = '';
    
    #[Validate('required')]
    public $nominal = '';
    
    #[Validate('required')]
    public $metode_pembayaran = '';
}
