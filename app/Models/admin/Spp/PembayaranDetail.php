<?php

namespace App\Models\Admin\Spp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_detail';

    protected $fillable = [
        'nama',
        'nominal',
        'jenjang_id',
    ];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }
}
