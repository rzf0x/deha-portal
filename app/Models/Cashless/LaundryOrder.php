<?php

namespace App\Models\Cashless;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'user_id', 'laundry_id', 'quantitiy', 'subtotal', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }

    public function services()
    {
        return $this->belongsTo(LaundryService::class);
    }
}
