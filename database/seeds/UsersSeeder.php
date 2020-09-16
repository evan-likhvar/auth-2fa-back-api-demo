<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'test.admin',
            'email' => 'test.admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('test.admin@gmail.com'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_params')->insert([
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'test.subAdmin',
            'email' => 'test.subAdmin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('test.subAdmin@gmail.com'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_params')->insert([
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'test.user',
            'email' => 'test.user@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('test.user@gmail.com'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('user_params')->insert([
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
