<?php

namespace Database\Seeders;

use App\Models\Admin\Spp\PembayaranCicilan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranCicilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PembayaranCicilan::create([
            'nominal' => '250000',
            'keterangan' => 'Cicilan pertama',
            'pembayaran_id' => 1, // Sesuaikan dengan ID pembayaran yang ada
            'tahun_ajaran_id' => date('Y'),
        ]);
    }
}
