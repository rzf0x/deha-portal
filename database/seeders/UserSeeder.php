<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'email' => 'admin-spp@example.com',
                'password' => Hash::make('password123')
            ],
        ];

        DB::table('users')->insert($data);
    }
}
