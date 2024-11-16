<?php

namespace App\Models\Admin\Spp;

use App\Models\Spp\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranCicilan extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_cicilan';

    protected $fillable = [
        'nominal',
        'keterangan',
        'pembayaran_id',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
