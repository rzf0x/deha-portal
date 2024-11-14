<?php

namespace App\Models\Cashless;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = ['user_id', 'product_id', 'quantity', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
