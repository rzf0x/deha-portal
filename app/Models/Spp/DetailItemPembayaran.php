<?php

namespace App\Models\Spp;

use App\Models\Jenjang;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailItemPembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_detail';

    protected $fillable = ['nama', 'nominal', 'jenjang_id', 'pembayaran_tipe_id', 'tahun_ajaran_id'];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }
    public function pembayaranTipe()
    {
        return $this->belongsTo(TipePembayaran::class);
    }
}
