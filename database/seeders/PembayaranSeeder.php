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
            'lunas', 'belum lunas', 'cicilan'
        ];

        // foreach (PembayaranTimeline::all() as $timeline) {
        //     $timeline->pembayarans()->create([
        //         'status' => $data[rand(0, 2)],
        //         'nominal' => '12',
        //         'metode_pembayaran' => 'cash',
        //         'pembayaran_tipe_id' => 1, // Sesuaikan dengan ID pembayaran_tipe yang ada
        //         'santri_id' => 1, // Sesuaikan dengan ID santri yang ada
        //         'pembayaran_timeline_id' => $timeline->id, // Sesuaikan dengan ID pembayaran_timeline yang ada
        //     ]);
        // }

        $testing = [
            [
                'status' => $data[rand(0, 2)],
                'nominal' => '12',
                'metode_pembayaran' => 'cash',
                'pembayaran_tipe_id' => 1, // Sesuaikan dengan ID pembayaran_tipe yang ada
                'santri_id' => 1, // Sesuaikan dengan ID santri yang ada
                'pembayaran_timeline_id' => 1,
            ],
        ];

        Pembayaran::insert($testing);
    }
}
