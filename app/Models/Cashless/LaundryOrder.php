<?php

namespace App\Models\Cashless;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $table = 'laundry_order';
    protected $fillable = ['user_id', 'laundry_service_id', 'quantity', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laundryService()
    {
        return $this->belongsTo(LaundryService::class);
    }
}
