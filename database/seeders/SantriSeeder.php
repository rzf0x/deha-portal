<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'foto'                  => '',
                'nama'                  => 'Muhammad Rajo',
                'nisn'                  => '0102100612',
                'nism'                  => '131232150027240102',
                'kewarganegaraan'       => 'WNI',
                'nik'                   => '3215125401100001',
                'tempat_lahir'          => 'Karawang',
                'tanggal_lahir'         => '2010-01-14',
                'jenis_kelamin'         => 'putera',
                'jumlah_saudara_kandung' => '1',
                'anak_ke'               => '1',
                // 'agama'                 => 'islam',
                'hobi'                  => 'membaca',
                'aktivitas_pendidikan'  => 'aktif',
                'npsn'                  => '70047049',
                'no_kip'                => 'MA Daarul Huffazh',
                'no_kk'                 => '3215122808070100',
                'nama_kepala_keluarga'   => 'MAMA',
                'kelas_id'              => 3,
                'kamar_id'              => 1,
                'riwayat_penyakit'      => 'sehat',
                'status_kesantrian'     => 'aktif',
                'status_santri'         => 'reguler',
            ],
            [
                'foto'                  => '',
                'nama'                  => 'Afifah Shawatul Shawa',
                'nisn'                  => '',
                'nism'                  => '131232150027240103',
                'kewarganegaraan'       => 'WNI',
                'nik'                   => '3215086511080003',
                'tempat_lahir'          => 'Karawang',
                'tanggal_lahir'         => '2008-11-25',
                'jenis_kelamin'         => 'puteri',
                'jumlah_saudara_kandung' => '1',
                'anak_ke'               => '1',
                // 'agama'                 => 'islam',
                'hobi'                  => 'kesenian',
                'aktivitas_pendidikan'  => 'aktif',
                'npsn'                  => '70047049',
                'no_kip'                => 'MA Daarul Huffazh',
                'no_kk'                 => '3215080304190021',
                'nama_kepala_keluarga'   => 'ROHATI',
                'kelas_id'              => 1,
                'kamar_id'              => 2,
                'riwayat_penyakit'      => 'sehat',
                'status_kesantrian'     => 'aktif',
                'status_santri'         => 'reguler',
            ],
        ];

        DB::table('santris')->insert($data);
    }
}
