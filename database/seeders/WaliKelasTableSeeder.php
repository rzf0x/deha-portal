<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliKelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wali_kelas')->insert([
            'nama' => 'Abdurahman Naufal',
            'alamat' => 'Yogyakarta',
            'foto' => 'nopal-ngakak',
            'no_whatsapp' => '098715215'
        ]);
    }
}
