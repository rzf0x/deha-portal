<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengumuman')->insert([
            [
                'judul' => 'Pengumuman Libur',
                'isi_pengumuman' => 'Pondok pesantren akan libur selama satu minggu mulai 25 November.',
                'tanggal' => '2024-11-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Jadwal Ujian Semester',
                'isi_pengumuman' => 'Ujian semester akan dimulai pada tanggal 1 Desember.',
                'tanggal' => '2024-11-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pengajian Akbar',
                'isi_pengumuman' => 'Akan diadakan pengajian akbar pada 27 November.',
                'tanggal' => '2024-11-23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perubahan Jadwal Belajar',
                'isi_pengumuman' => 'Jadwal belajar akan berubah mulai minggu depan.',
                'tanggal' => '2024-11-21',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Penerimaan Santri Baru',
                'isi_pengumuman' => 'Pendaftaran santri baru dibuka mulai 1 Januari.',
                'tanggal' => '2024-11-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
