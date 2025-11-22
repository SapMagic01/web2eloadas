<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('allat')->insert([
        [
            'id' => 1839,
            'nev' => 'pannon gyík',
            'ertekid' => 1,
            'ev' => 1974,
            'katid' => 6
        ],
        [
            'id' => 1886,
            'nev' => 'kis héja',
            'ertekid' => 2,
            'ev' => 1954,
            'katid' => 3
        ],
        [
            'id' => 1979,
            'nev' => 'farkas',
            'ertekid' => 2,
            'ev' => 1993,
            'katid' => 7
        ],
    ]);
    }
}
