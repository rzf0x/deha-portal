<?php

namespace App\Models\ESantri;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    use HasFactory;

    protected $table = 'jadwal_piket';

    protected $fillable = ['santri_id', 'kelas_id', 'hari', 'keterangan', 'waktu','role_guru'];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
