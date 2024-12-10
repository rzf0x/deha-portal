<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';
    
    protected $fillable = [
        'kelas_id', 
        'kategori_pelajaran_id', 
        'mata_pelajaran', 
        'waktu_mulai', 
        'waktu_selesai', 
        'hari'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kategoriPelajaran()
    {
        return $this->belongsTo(kategoriPelajaran::class);
    }

    protected $casts = [
        'waktu_mulai' => 'datetime:H:i',
        'waktu_selesai' => 'datetime:H:i'
    ];
    
}