<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'foto',
        'role',
        'no_whatsapp',
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'wali_kamar');
    }
}
