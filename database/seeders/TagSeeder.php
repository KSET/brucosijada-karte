<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'Crveni',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'Sponzor',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'FER',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'Brucoš',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'Izvođač',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'Press',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'KSET+1',
            'deleted' => 0,
        ]);
        DB::table('tags')->insert([
            'name' => 'Ostali',
            'deleted' => 0,
        ]);
    }
}
