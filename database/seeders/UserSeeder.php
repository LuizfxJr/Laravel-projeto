<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(User::class)->create([
            'name'              => 'Grupo Roma',
            'email'             => 'admin@groma.com.br',
            'code'              => '1',
            'user_level'        => 'administrator',
            'occupation_id'     => '1',
            'sector_id'         => '1',
            'password'          => bcrypt('groma123')
        ]);
    }
}
