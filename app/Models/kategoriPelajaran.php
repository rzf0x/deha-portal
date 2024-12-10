<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPelajaran extends Model
{
    protected $table = 'kategori_pelajaran';
    
    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function jadwalPelajaran()
    {
        return $this->hasMany(JadwalPelajaran::class);
    }
}