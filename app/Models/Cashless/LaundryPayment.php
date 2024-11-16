<?php

namespace App\Models\Cashless;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'laundry_order_id',
        'payment_method',
        'payment_status',
        'payment_date',
        'amount',
        'kembalian'
    ];

    public function laundryOrder()
    {
        return $this->belongsTo(LaundryOrder::class);
    }
}