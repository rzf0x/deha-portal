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
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
