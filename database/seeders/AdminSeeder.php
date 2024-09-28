<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 2,
                'roles_id' => 2
            ],
            [
                'user_id' => 1,
                'roles_id' => 1,
            ]
        ];

        DB::table('admins')->insert($data);
    }
}
