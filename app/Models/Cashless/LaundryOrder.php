<?php

namespace App\Models\Cashless;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $table = 'laundry_orders';
    protected $fillable = [
        'order_number',
        'nama_santri',
        'laundry_service_id',
        'quantity',
        'subtotal',
        'status',
        'end_date',
    ];

     public function laundryService()
     {
         return $this->belongsTo(LaundryService::class);
     }
}
