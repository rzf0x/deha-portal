<?php

namespace App\Models;

use App\Models\Spp\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'user_id', 'kelas_id', 'kamar_id', 'tahun_akademik_id', 'foto', 'tempat_lahir', 'tanggal_lahir', 'riwayat_penyakit', 'status_kesantrian', 'status_santri', 'semester_id', 'angkatan_id', 'jenis_kelamin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // public function semester()
    // {
    //     return $this->belongsTo(Semester::class);
    // }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    // public function orangTuaSantri()
    // {
    //     return $this->hasOne(OrangTuaSantri::class);
    // }

    public function Pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
