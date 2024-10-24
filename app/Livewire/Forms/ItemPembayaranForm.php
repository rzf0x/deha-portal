<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ItemPembayaranForm extends Form
{
    //
    #[Validate('required')]
    public $nama;
    #[Validate('required|integer')]
    public $nominal;
    #[Validate('required')]
    public $jenjang_id;
}
