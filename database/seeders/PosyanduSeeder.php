<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posyandu')->insert([
            'nama' => 'Melati',
        ]);

        DB::table('posyandu')->insert([
            'nama' => 'Wijaya Kusuma',
        ]);

        DB::table('posyandu')->insert([
            'nama' => 'Kana',
        ]);

        DB::table('posyandu')->insert([
            'nama' => 'Wora Wiri',
        ]);

        DB::table('posyandu')->insert([
            'nama' => 'Mekarsari',
        ]);

        DB::table('posyandu')->insert([
            'nama' => 'Kenanga',
        ]);

        DB::table('posyandu')->insert([
            'nama' => 'Mawar',
        ]);
    }
}
