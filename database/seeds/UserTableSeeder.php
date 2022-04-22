<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Arr;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */





    public function run()
    {

        DB::table('users')->delete();

        User::create([

            'name' => 'AhmedMofrih',
            'email' => 'user2email@emil.com',
            'password' => bcrypt('123456789'),


        ]);
    }
}
