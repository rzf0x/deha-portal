<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LaundryServiceForm extends Form
{
    #[Validate('required|string')]
    public $name;

    #[Validate('required|string')]
    public $description;

    #[Validate('required|string')]
    public $estimate;
    
    #[Validate('required|string')]
    public $unit = 'Kg';

    #[Validate('required|numeric|min:0')]
    public $price;
}
