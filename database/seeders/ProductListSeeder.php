<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugasWarungRole = DB::table('roles')->where('nama', 'Petugas Warung')->first();
        $sellers = User::where('roles_id', $petugasWarungRole->id)->pluck('id');

        $categories = DB::table('categories')->pluck('id');

        $products = [
            [
                'product_number' => 'PRD-' . Str::random(6),
                'name' => 'Indomie Goreng',
                'foto' => null,
                'description' => 'Mie instan populer dengan bumbu pedas',
                'price' => 3500.00,
                'stok' => 100,
                'seller_id' => $sellers->first(),
                'category_id' => $categories->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_number' => 'PRD-' . Str::random(6),
                'name' => 'Teh Botol Sosro',
                'foto' => null,
                'description' => 'Minuman teh dalam kemasan botol',
                'price' => 5000.00,
                'stok' => 75,
                'seller_id' => $sellers->first(),
                'category_id' => $categories->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_number' => 'PRD-' . Str::random(6),
                'name' => 'Keripik Pisang',
                'foto' => null,
                'description' => 'Camilan renyah dari pisang pilihan',
                'price' => 10000.00,
                'stok' => 50,
                'seller_id' => $sellers->first(),
                'category_id' => $categories->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_number' => 'PRD-' . Str::random(6),
                'name' => 'Air Mineral Aqua Gelas',
                'foto' => null,
                'description' => 'Air mineral dalam kemasan gelas',
                'price' => 2000.00,
                'stok' => 200,
                'seller_id' => $sellers->first(),
                'category_id' => $categories->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_number' => 'PRD-' . Str::random(6),
                'name' => 'Kopi Sachet ABC',
                'foto' => null,
                'description' => 'Kopi instan praktis dalam sachet',
                'price' => 2500.00,
                'stok' => 150,
                'seller_id' => $sellers->first(),
                'category_id' => $categories->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('products')->insert($products);
    }
}
