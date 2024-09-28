<?php

namespace App\Models\Spp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_tipe';

    protected $fillable = [
        'nama',
    ];

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
