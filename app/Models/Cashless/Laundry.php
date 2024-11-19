<?php

namespace App\Models\Cashless;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $table = 'laundries';
    protected $fillable = ['user_id', 'name', 'address', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(LaundryService::class);
    }

    public function orders()
    {
        return $this->hasMany(LaundryOrder::class);
    }
}
