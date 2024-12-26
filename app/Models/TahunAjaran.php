<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajarans';
    protected $primaryKey = 'nama_tahun'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 
    
    protected $fillable = [
        'nama_tahun',
    ];
}
