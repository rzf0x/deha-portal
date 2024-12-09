<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
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
                'roles_id' => 1,
                'name' => 'User',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 2,
                'name' => 'User',
                'email' => 'admin-spp@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 3,
                'name' => 'User',
                'email' => 'petugas-e-cashless@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 4,
                'name' => 'User',
                'email' => 'petugas-warung@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 5,
                'name' => 'User',
                'email' => 'petugas-laundry@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 6,
                'name' => 'Muhammad Rajo',
                'email' => 'santri@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 7,
                'name' => 'Asep Suebarjo',
                'email' => 'guru-diniyyah@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'roles_id' => 8,
                'name' => 'Jaenab Suenidin',
                'email' => 'guru@example.com',
                'password' => Hash::make('password123')
            ],
        ];

        DB::table('users')->insert($data);
    }
}
