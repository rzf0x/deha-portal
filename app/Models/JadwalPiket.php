<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    use HasFactory;

    protected $table = 'jadwal_piket';

    protected $fillable = ['santri_id', 'kelas_id', 'hari','keterangan','waktu'];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    
    public static $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    public static $waktuList = ['pagi', 'siang', 'sore', 'malam'];
}
