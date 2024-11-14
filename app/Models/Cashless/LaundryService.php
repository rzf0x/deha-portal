<?php

namespace App\Models\Cashless;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $table = 'laundry_service';
    protected $fillable = ['laundry_id', 'name', 'description', 'price'];

    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }
}
