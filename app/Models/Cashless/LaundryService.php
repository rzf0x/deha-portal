<?php

namespace App\Models\Cashless;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $fillable = ['laundry_id', 'name', 'description', 'price'];

    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }

    // Relasi Many-to-Many dengan LaundryOrder
    public function orders()
    {
        return $this->hasMany(Laundry::class);
    }
}
