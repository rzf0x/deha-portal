<?php

namespace App\Models\Cashless;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = ['transaction_items_id', 'payment_method', 'bukti_pembayaran', 'payment_status', 'payment_date', 'amount', 'returns'];

    public function order()
    {
        return $this->belongsTo(TransactionItem::class);
    }
    
    public function paymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class);
    }
}
