<?php

namespace App\Models\Cashless;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $table = 'laundry_services';
    protected $fillable = ['name', 'description', 'price', 'unit', 'estimate'];

    public function orders()
    {
        return $this->hasMany(LaundryOrder::class);
    }
}
