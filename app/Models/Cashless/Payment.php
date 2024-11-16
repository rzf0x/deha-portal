<?php

namespace App\Models\Cashless;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = ['transaction_id', 'payment_method', 'payment_status', 'payment_date', 'amount', 'kembalian'];

    public function order()
    {
        return $this->belongsTo(Transaction::class);
    }
}
