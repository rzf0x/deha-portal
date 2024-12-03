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
                'user_id' => 1,
                'roles_id' => 1,
            ],
            [
                'user_id' => 2,
                'roles_id' => 2
            ],
            [
                'user_id' => 3,
                'roles_id' => 3
            ],
            [
                'user_id' => 4,
                'roles_id' => 4
            ],
            [
                'user_id' => 5,
                'roles_id' => 5
            ],
            // ! 6 santri !
            [
                'user_id' => 7,
                'roles_id' => 7
            ],
            [
                'user_id' => 8,
                'roles_id' => 8
            ],
        ];

        DB::table('admins')->insert($data);
    }
}
