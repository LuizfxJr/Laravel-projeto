<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sector')->insert([
            ['description'=>'Administração'],
            ['description'=>'Vendas'],
            ['description'=>'RH'],
        ]);
    }
}
