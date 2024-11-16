<?php

namespace App\Models\Cashless;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['laundry_order_id', 'laundry_service_id', 'quantity', 'price', 'subtotal', 'notes'];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'laundry_order_id');
    }

    public function service()
    {
        return $this->belongsTo(LaundryService::class, 'laundry_service_id');
    }
}