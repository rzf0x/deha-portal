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
            RoleSeeder::class,
            UserSeeder::class,
            WaliKamarTableSeeder::class,
            KamarTableSeeder::class,
            SantriSeeder::class,
            AngkatanSeeder::class,
            SemesterSeeder::class,
            AdminSeeder::class,
            PembayaranTimelineSeeder::class,
            PembayaranTipeSeeder::class,
            PembayaranDetailSeeder::class,
            PembayaranSeeder::class,
            OrangTuaSeeder::class,
            LaundryServiceSeeder::class,
            ProductCategorySeeder::class,
            ProductListSeeder::class,
            PengumumanSeeder::class,
            KegiatanSeeder::class,
        ]);
    }
}
