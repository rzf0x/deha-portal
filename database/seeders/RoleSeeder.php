<?php

namespace Database\Seeders;

use App\Models\admin\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nama' => 'Super Admin'
            ],
            [
                'nama' => 'Petugas SPP'
            ],
            [
                'nama' => 'Petugas E-Cashless'
            ],
            [
                'nama' => 'Petugas Warung'
            ],
            [
                'nama' => 'Petugas Laundry'
            ],
            [
                'nama' => 'Santri'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
