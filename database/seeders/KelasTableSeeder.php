<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Kelas X A',
                'wali_kelas' => 1,
                'jenjang_id' => 1,
            ],
            [
                'nama' => 'Kelas X B',
                'wali_kelas' => 1,
                'jenjang_id' => 2,
            ],
            [
                'nama' => 'Kelas XI A',
                'wali_kelas' => 1,
                'jenjang_id' => 3,
            ],
            [
                'nama' => 'Kelas XI B',
                'wali_kelas' => 1,
                'jenjang_id' => 1,
            ],
            [
                'nama' => 'Kelas XII A',
                'wali_kelas' => 1,
                'jenjang_id' => 4,
            ],
            [
                'nama' => 'Kelas XII B',
                'wali_kelas' => 1,
                'jenjang_id' => 5,
            ],
        ];

        DB::table('kelas')->insert($data);
    }
}
