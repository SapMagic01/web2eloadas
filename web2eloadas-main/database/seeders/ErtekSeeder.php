<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ErtekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ertek')->insert([
            ['id' => 1, 'forint' => 100000],
            ['id' => 2, 'forint' => 250000],
            ['id' => 3, 'forint' => 500000],
            ['id' => 4, 'forint' => 1000000],
        ]);
    }
}
