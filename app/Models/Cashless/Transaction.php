<?php

namespace App\Models\Cashless;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_number', 'user_id', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_items')
            ->withPivot('quantity', 'price', 'subtotal')
            ->withTimestamps();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
