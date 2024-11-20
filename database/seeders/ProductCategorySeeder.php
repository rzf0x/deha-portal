<?php

namespace Database\Seeders;

use App\Models\Cashless\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderNumber = 'CAT-' . date('YmdHis');

        $categories = [
            ['name' => 'Makanan Pembuka'],
            ['name' => 'Makanan Utama'],
            ['name' => 'Makanan Penutup'],
            ['name' => 'Minuman'],
            ['name' => 'Cemilan'],
        ];

        foreach ($categories as $index => $category) {
            Category::create([
                'category_number' => $orderNumber . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT), 
                'name' => $category['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
