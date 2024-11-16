<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('orang_tua_santris')->insert([
            [
                'santri_id' => 1, // Adjust as necessary
                'nama_ayah' => 'Budi Santoso',
                'status_ayah' => 'hidup',
                'kewarganegaraan_ayah' => 'wni',
                'nik_ayah' => '1234567890123',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1980-01-01',
                'pendidikan_terakhir_ayah' => 'sarjana',
                'pekerjaan_ayah' => 'Guru',
                'penghasilan_ayah' => '5000000',
                'no_telp_ayah' => '08123456789',
                'nama_ibu' => 'Siti Aminah',
                'status_ibu' => 'hidup',
                'kewarganegaraan_ibu' => 'wni',
                'nik_ibu' => '9876543210987',
                'tempat_lahir_ibu' => 'Bandung',
                'tanggal_lahir_ibu' => '1985-02-02',
                'pendidikan_terakhir_ibu' => 'diploma',
                'pekerjaan_ibu' => 'Perawat',
                'penghasilan_ibu' => '4000000',
                'no_telp_ibu' => '08234567890',
                'status_kepemilikan_rumah' => 'milik sendiri',
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Bandung',
                'kecamatan' => 'Cidadap',
                'kelurahan' => 'Cimahi',
                'rt' => '01',
                'rw' => '02',
                'alamat' => 'Jl. Raya No. 1',
                'kode_pos' => '40511',
                'status_orang_tua' => 'kawin',
            ],
            [
                'santri_id' => 2, // Adjust as necessary
                'nama_ayah' => 'Budi Santoso',
                'status_ayah' => 'hidup',
                'kewarganegaraan_ayah' => 'wni',
                'nik_ayah' => '1234567890123',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1980-01-01',
                'pendidikan_terakhir_ayah' => 'sarjana',
                'pekerjaan_ayah' => 'Guru',
                'penghasilan_ayah' => '5000000',
                'no_telp_ayah' => '08123456789',
                'nama_ibu' => 'Siti Aminah',
                'status_ibu' => 'hidup',
                'kewarganegaraan_ibu' => 'wni',
                'nik_ibu' => '9876543210987',
                'tempat_lahir_ibu' => 'Bandung',
                'tanggal_lahir_ibu' => '1985-02-02',
                'pendidikan_terakhir_ibu' => 'diploma',
                'pekerjaan_ibu' => 'Perawat',
                'penghasilan_ibu' => '4000000',
                'no_telp_ibu' => '08234567890',
                'status_kepemilikan_rumah' => 'milik sendiri',
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Bandung',
                'kecamatan' => 'Cidadap',
                'kelurahan' => 'Cimahi',
                'rt' => '01',
                'rw' => '02',
                'alamat' => 'Jl. Raya No. 1',
                'kode_pos' => '40511',
                'status_orang_tua' => 'kawin',
            ],
        ]);
    }
}
