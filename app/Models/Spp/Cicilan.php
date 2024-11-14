<?php

namespace App\Models\Spp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_cicilan';

    protected $fillable = [
        'nominal',
        'keterangan',
        'bukti_pembayaran',
        'pembayaran_id',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
