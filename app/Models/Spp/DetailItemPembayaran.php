<?php

namespace App\Models\Spp;

use App\Models\Jenjang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailItemPembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_detail';

    protected $fillable = ['nama', 'nominal', 'jenjang_id'];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }
}
