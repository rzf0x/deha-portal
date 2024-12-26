<?php

namespace Database\Seeders;

use App\Livewire\Admin\Spp\Pembayaran as SppPembayaran;
use App\Models\Spp\Pembayaran;
use App\Models\Spp\PembayaranTimeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'lunas', 'belum bayar', 'cicilan'
        ];


        $testing = [
            [
                'status' => $data[rand(0, 2)],
                'nominal' => 12000,
                'metode_pembayaran' => 'cash',
                'pembayaran_tipe_id' => 1, // Sesuaikan dengan ID pembayaran_tipe yang ada
                'santri_id' => 1, // Sesuaikan dengan ID santri yang ada
                'pembayaran_timeline_id' => 11,
                'tahun_ajaran_id' => date('Y'),
            ],
        ];

        foreach ($testing as $item) {
            Pembayaran::create($item);
        }
    }
}
