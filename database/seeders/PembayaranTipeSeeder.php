<?php

namespace Database\Seeders;

use App\Models\Spp\TipePembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranTipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['SPP', 'Uang Buku', 'Uang Seragam'];

        foreach ($types as $type) {
            TipePembayaran::create(['nama' => $type]);
        }
    }
}
