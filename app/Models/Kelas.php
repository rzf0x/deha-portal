<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['nama', 'wali_kelas', 'jenjang_id'];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function waliKelas()
    {
        return $this->belongsTo(WaliKelas::class, 'wali_kelas');
    }

    public function santri()
    {
        return $this->hasMany(Santri::class);
    }
}
