<?php

namespace Database\Seeders;

use App\Models\Admin\Spp\PembayaranDetail;
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
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran Uang Makan bulanan',
                'nominal' => '100000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran Laundry bulanan',
                'nominal' => '50000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran 1 bulanan',
                'nominal' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran 2 bulanan',
                'nominal' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
        ];

        PembayaranDetail::insert($data);
    }
}
