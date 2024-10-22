<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            ['nama' => 'Semester 1'],
            ['nama' => 'Semester 2'],
            ['nama' => 'Semester 3'],
            ['nama' => 'Semester 4'],
            ['nama' => 'Semester 5'],
            ['nama' => 'Semester 6'],
            ['nama' => 'Semester 7'],
            ['nama' => 'Semester 8'],
            ['nama' => 'Semester 9'],
            ['nama' => 'Semester 10'],
            ['nama' => 'Semester 11'],
            ['nama' => 'Semester 12'],
        ]);
    }
}
