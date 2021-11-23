<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'name'=>'desenvolvimento', 
            'email'=>'desenvolvimento@saude.mg.gov.br',
            'password'=>Hash::make('desenvolvimento@2021'),
        ]);
    }
}
