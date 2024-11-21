<?php

namespace App\Models\Cashless;

use App\Models\Cashless\Product as CashlessProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = ['transaction_number', 'user', 'subtotal', 'total', 'notes'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function products()
    {
        return $this->belongsToMany(CashlessProduct::class, 'transaction_items')
            ->withPivot('quantity', 'price', 'subtotal')
            ->withTimestamps();
    }
}
