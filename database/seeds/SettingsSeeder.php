<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'name' => 'interest_rate',
            'value' => 1,
            'default_value' => null,
            'description' => 'Процентная ставка',
            'type_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);

        DB::table('settings')->insert([
            'id' => 2,
            'name' => 'bonus_limit',
            'value' => 1,
            'default_value' => '1000',
            'description' => 'Bonus Limit',
            'type_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);

        DB::table('settings')->insert([
            'id' => 3,
            'name' => 'dashboard_period',
            'value' => 1,
            'default_value' => 'null',
            'description' => 'Bonus Limit',
            'type_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
    }
}
