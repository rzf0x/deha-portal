<?php

namespace App\Models\Spp;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [ 
        'status',
        'nominal',
        'metode_pembayaran',
        'pembayaran_tipe_id',
        'santri_id',
        'pembayaran_timeline_id',
        'bukti_pembayaran',
        'tahun_ajaran_id',
    ];

    public function pembayaranTipe()
    {
        return $this->belongsTo(TipePembayaran::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function pembayaranTimeline()
    {
        return $this->belongsTo(PembayaranTimeline::class);
    }

    public function cicilans()
    {
        return $this->hasMany(Cicilan::class);
    }
}
