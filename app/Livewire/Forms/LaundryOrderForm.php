<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LaundryOrderForm extends Form
{
    #[Validate('required|string|unique:laundry_orders,order_number')]
    public $order_number;

    #[Validate('required')]
    public $santri_id;

    #[Validate('required|exists:laundry_services,id')]
    public $laundry_service_id;

    #[Validate('required|integer|min:1')]
    public $quantity = 1;

    #[Validate('required|decimal:0,2|min:0')]
    public $subtotal = 0;

    #[Validate('required|in:menunggu,dicuci,gagal,disetrika,siap diambil,diterima')]
    public $status = 'menunggu';

    #[Validate('required|string')] 
    public $end_date;
}
