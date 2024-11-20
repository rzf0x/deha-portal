<?php

namespace App\Models\Cashless;

use App\Models\Cashless\Product as CashlessProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    protected $fillable = ['category_number', 'name'];

    public function products()
    {
        return $this->hasMany(CashlessProduct::class);
    }
}
