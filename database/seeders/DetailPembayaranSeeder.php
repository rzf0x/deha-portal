<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Pembayaran SPP bulanan',
                'harga' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran Uang Makan bulanan',
                'harga' => '100000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran Laundry bulanan',
                'harga' => '50000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran 1 bulanan',
                'harga' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
            [
                'nama' => 'Pembayaran 2 bulanan',
                'harga' => '200000',
                'jenjang_id' => 1,
                'pembayaran_tipe_id' => 1
            ],
        ];

        DB::table('detail_items_pembayarans')->insert($data);
    }
}
