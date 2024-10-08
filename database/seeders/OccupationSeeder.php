<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupations')->insert([
            ['description'=>'Administrador'],
            ['description'=>'RH'],
            ['description'=>'Vendedor'],
            ['description'=>'Corretor'],
        ]);
    }
}
