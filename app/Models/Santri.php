<?php

namespace App\Models;

use App\Models\admin\Angkatan;
use App\Models\admin\Semester;
use App\Models\Cashless\LaundryOrder;
use App\Models\Spp\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santris';
    protected $fillable = [
        'foto',
        'nama',
        'nisn',
        'nism',
        'kewarganegaraan',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'jumlah_saudara_kandung',
        'anak_ke',
        'agama',
        'hobi',
        'aktivitas_pendidikan',
        'npsn',
        'no_kip',
        'no_kk',
        'nama_kepala_keluarga',
        'riwayat_penyakit',
        'status_kesantrian',
        'status_santri',
        'asal_sekolah',
        'yang_membiayai_sekolah',

        'kelas_id',
        'kamar_id',
        'semester_id',
        'angkatan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nisn', 'email');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function orangTuaSantri()
    {
        return $this->hasOne(OrangTuaSantri::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function laundry()
    {
        return $this->hasMany(LaundryOrder::class);
    }

    public function jadwalPiket()
    {
        return $this->hasMany(JadwalPiket::class);
    }
}
