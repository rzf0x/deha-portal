<?php

namespace App\Models;

use App\Models\Cashless\Category;
use App\Models\Cashless\Order;
use App\Models\Cashless\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'seller_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_items')
            ->withPivot('quantity', 'price', 'subtotal')
            ->withTimestamps();
    }
}
