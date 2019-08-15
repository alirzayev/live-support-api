<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Orkhan Alirzayev',
            'email' => 'alirzayev.07@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
