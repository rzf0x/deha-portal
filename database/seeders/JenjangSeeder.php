<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenjangs = [
            ['nama' => 'SMPI Daarul Huffazh'],
            ['nama' => 'MA Daarul Huffazh'],
            ['nama' => 'Takhosus Daarul Huffazh'],
            ['nama' => 'SD Daarul Huffazh'],
            ['nama' => 'PAUD Daarul Huffazh'],
        ];

        foreach ($jenjangs as $jenjang) {
            Jenjang::create($jenjang);
        }
    }
}
