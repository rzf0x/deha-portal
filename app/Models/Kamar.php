<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'wali_kamar',
        'kamar_tipe'
    ];

    public function waliKamar()
    {
        return $this->belongsTo(WaliKamar::class, 'wali_kamar');
    }
}
