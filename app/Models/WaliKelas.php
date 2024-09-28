<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'foto',
        'no_whatsapp',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas');
    }
}
