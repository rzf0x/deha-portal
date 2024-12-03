<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryProductForm extends Form
{
    #[Validate('required')]
    public $product_number;

    #[Validate('required')]
    public $name;
}
