<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('angkatans')->insert([
            ['nama' => 'Angkatan 2020'],
            ['nama' => 'Angkatan 2021'],
            ['nama' => 'Angkatan 2022'],
        ]);
    }
}
