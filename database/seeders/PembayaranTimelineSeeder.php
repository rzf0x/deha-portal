<?php

namespace Database\Seeders;

use App\Models\Spp\PembayaranTimeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        foreach ($months as $month) {
            PembayaranTimeline::create(['nama_bulan' => $month]);
        }
    }
}
