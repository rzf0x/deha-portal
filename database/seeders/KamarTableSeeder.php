<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Kamar Umar bin Khattab',
                'wali_kamar' => 1,
                'kamar_tipe' => 'putera',
            ],
            [
                'nama' => 'Kamar Siti Khadijah',
                'wali_kamar' => 2,
                'kamar_tipe' => 'puteri',
            ],
        ];

        Kamar::insert($data);
    }
}
