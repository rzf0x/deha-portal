<?php

namespace App\Models\Cashless;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $table = 'laundries';
    protected $fillable = ['user_id', 'name', 'address', 'phone_number'];

    public function services()
    {
        return $this->hasMany(LaundryService::class);
    }
}
