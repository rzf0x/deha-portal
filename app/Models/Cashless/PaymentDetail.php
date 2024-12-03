<?php

namespace App\Models\Cashless;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details';
    protected $fillable = ['payment_id', 'notes'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
