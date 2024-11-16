<?php

namespace App\Models\Cashless;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'user_id', 'laundry_id', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }

    // Relasi Many-to-Many dengan LaundryService
    public function services()
    {
        return $this->belongsToMany(LaundryService::class, 'laundry_order_items')
                    ->withPivot('quantity', 'price', 'subtotal', 'notes')
                    ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(LaundryPayment::class);
    }
}
