<?php

namespace App\Models\Cashless;

use App\Models\Cashless\Product as CashlessProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(CashlessProduct::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
