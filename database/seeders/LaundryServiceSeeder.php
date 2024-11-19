<?php

namespace Database\Seeders;

use App\Models\Cashless\LaundryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaundryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Kiloan',
                'description' => 'Layanan cuci dan pengeringan pakaian.',
                'unit' => "Kg",
                'estimate' => '3 hari',
                'price' => 50000.00,
            ],
            [
                'name' => 'Satuan',
                'description' => 'Layanan cuci dan setrika satuan.',
                'unit' => "Pcs",
                'estimate' => '2 hari',
                'price' => 5000.00,
            ],
            [
                'name' => 'Cuci Sepatu',
                'description' => 'Layanan pembersihan sepatu.',
                'unit' => "Pcs",
                'estimate' => '3 hari',
                'price' => 30000.00,
            ],
            [
                'name' => 'Cuci Karpet',
                'description' => 'Layanan pembersihan karpet.',
                'unit' => "Pcs",
                'estimate' => '5 hari',
                'price' => 150000.00,
            ],
        ];

        foreach ($services as $service) {
            LaundryService::create($service);
        }
    }
}
