<?php

namespace Database\Seeders;

use App\Models\WaliKamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaliKamarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Fitri Izzatul Islam',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'puteri',
            ], // 1
            [
                'nama' => 'Ratu Alkayagnik',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'puteri',
            ], // 2
            [
                'nama' => 'Aida fitri nur',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'puteri',
            ], // 3
            [
                'nama' => 'Sholihah',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'puteri',
            ], // 4
            [
                'nama' => 'Irma sari',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'puteri',
            ], // 5
            [
                'nama' => 'nur farikhah',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'puteri',
            ], // 6
            [
                'nama' => 'Feri Mustari',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 7
            [
                'nama' => 'Yalu Wala Yula alaih',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 8
            [
                'nama' => 'H. Zainal Arifin',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 9
            [
                'nama' => 'Abdullah Zamhari',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 10
            [
                'nama' => 'Ade Abdurahman Wahid',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 11
            [
                'nama' => 'Muhamad Ihsan Maulana',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 12
            [
                'nama' => 'Nuryadin',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 13
            [
                'nama' => 'Yuhana Sofyan',
                'alamat' => 'Leuwi Panjang',
                'no_whatsapp' => '085659670321',
                'role' => 'putera',
            ], // 14
        ];

        WaliKamar::insert($data);
    }
}
