<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTuaSantri extends Model
{
    use HasFactory;

    protected $table = 'orang_tua_santris';
    protected $fillable = [
        'santri_id',
        'nama_ayah',
        'status_ayah',
        'kewarganegaraan_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'no_telp_ayah',

        'nama_ibu',
        'status_ibu',
        'kewarganegaraan_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'no_telp_ibu',
        
        'status_kepemilikan_rumah',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'rt',
        'rw',
        'alamat',
        'kode_pos',
        'status_orang_tua',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}
