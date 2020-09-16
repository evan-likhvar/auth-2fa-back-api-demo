<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'CAN_VIEW_SUPER',
            'display_name' => 'CAN_VIEW_EVERYTHING',
            'description' => 'CAN_VIEW_EVERYTHING',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'CAN_VIEW_SUB_ADMIN',
            'display_name' => 'CAN_VIEW_SUB_ADMIN',
            'description' => 'CAN_VIEW_SUB_ADMIN',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'CAN_VIEW_USER',
            'display_name' => 'CAN_VIEW_USER',
            'description' => 'CAN_VIEW_USER',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
