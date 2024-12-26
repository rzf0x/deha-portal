<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = date('Y') - 5; $i <= date('Y') + 10; $i++){
            TahunAjaran::create(['nama_tahun' => $i]);
        }
    }
}
