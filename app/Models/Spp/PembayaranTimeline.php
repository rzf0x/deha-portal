<?php

namespace App\Models\Spp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranTimeline extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_timeline';

    protected $fillable = [
        'nama_bulan',
    ];

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
