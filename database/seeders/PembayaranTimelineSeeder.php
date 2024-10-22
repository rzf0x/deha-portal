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
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        foreach ($months as $month) {
            PembayaranTimeline::create(['nama_bulan' => $month]);
        }
    }
}
