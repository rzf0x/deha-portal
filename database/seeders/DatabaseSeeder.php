<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WaliKelasTableSeeder::class,
            JenjangSeeder::class,
            KelasTableSeeder::class,
            UserSeeder::class,
            WaliKamarTableSeeder::class,
            KamarTableSeeder::class,
            SantriSeeder::class,
            AngkatanSeeder::class,
            SemesterSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            PembayaranTimelineSeeder::class,
            PembayaranTipeSeeder::class,
            PembayaranDetailSeeder::class,
            PembayaranSeeder::class,
            OrangTuaSeeder::class
        ]);
    }
}
