<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan')->insert([
            [
                'judul' => 'Kajian Tafsir Al-Quran',
                'isi_kegiatan' => 'Kajian Tafsir Al-Quran akan diadakan di Masjid Utama.',
                'waktu_mulai' => '2024-11-23 08:00:00',
                'waktu_selesai' => '2024-11-23 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Lomba Tahfidzul Quran',
                'isi_kegiatan' => 'Lomba tahfidzul Quran tingkat pondok.',
                'waktu_mulai' => '2024-11-25 09:00:00',
                'waktu_selesai' => '2024-11-25 12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Workshop Public Speaking',
                'isi_kegiatan' => 'Workshop untuk meningkatkan kemampuan public speaking.',
                'waktu_mulai' => '2024-11-26 13:00:00',
                'waktu_selesai' => '2024-11-26 15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kegiatan Olahraga',
                'isi_kegiatan' => 'Pertandingan futsal antar kelas.',
                'waktu_mulai' => '2024-11-27 07:00:00',
                'waktu_selesai' => '2024-11-27 09:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Seminar Motivasi',
                'isi_kegiatan' => 'Seminar motivasi bersama ustaz terkenal.',
                'waktu_mulai' => '2024-11-28 09:00:00',
                'waktu_selesai' => '2024-11-28 11:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
