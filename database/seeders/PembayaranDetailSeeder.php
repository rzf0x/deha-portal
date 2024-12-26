<?php

namespace Database\Seeders;

use App\Models\Admin\Spp\PembayaranDetail;
use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'nama' => 'Pembayaran SPP bulanan',
                'nominal' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1,
                'tahun_ajaran_id' => date('Y'),
            ],
            [
                'nama' => 'Pembayaran Uang Makan bulanan',
                'nominal' => '100000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1,
                'tahun_ajaran_id' => date('Y'),
            ],
            [
                'nama' => 'Pembayaran Laundry bulanan',
                'nominal' => '50000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1,
                'tahun_ajaran_id' => date('Y'),
            ],
            [
                'nama' => 'Pembayaran 1 bulanan',
                'nominal' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1,
                'tahun_ajaran_id' => date('Y'),
            ],
            [
                'nama' => 'Pembayaran 2 bulanan',
                'nominal' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1,
                'tahun_ajaran_id' => date('Y'),
            ],
        ];

        PembayaranDetail::insert($data);
    }
}
