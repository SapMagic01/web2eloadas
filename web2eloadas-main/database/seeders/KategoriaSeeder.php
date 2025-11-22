<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoria')->insert([
            ['id' => 1, 'nev' => 'halak'],
            ['id' => 2, 'nev' => 'körszájúak'],
            ['id' => 3, 'nev' => 'madarak'],
            ['id' => 4, 'nev' => 'kétéltűek'],
            ['id' => 5, 'nev' => 'puhatestűek'],
            ['id' => 6, 'nev' => 'hüllők'],
            ['id' => 7, 'nev' => 'emlősök'],
            ['id' => 8, 'nev' => 'ízeltlábúak'],
        ]);
    }
}
