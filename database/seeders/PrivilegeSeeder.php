<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            'name' => 'Admin',
            'deleted' => 0,
        ]);
        DB::table('privileges')->insert([
            'name' => 'Gate',
            'deleted' => 0,
        ]);
        DB::table('privileges')->insert([
            'name' => 'Sale',
            'deleted' => 0,
        ]);
    }
}
