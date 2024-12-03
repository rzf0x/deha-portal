<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductListForm extends Form
{
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $category_id;

    #[Validate('required')]
    public $seller_id;

    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif|max:2048')]
    public $foto;

    #[Validate('nullable')]
    public $description;

    #[Validate('required')]
    public $price;

    #[Validate('required')]
    public $stok;
}
