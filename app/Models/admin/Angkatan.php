<?php

namespace App\Models\admin;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;

    protected $table = 'angkatans';

    protected $fillable = ['nama'];

    public function santri()
    {
        return $this->hasMany(Santri::class);
    }
}
