<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'interest_rate' => 3,
            'dashboard_period' => 3,
            'bonus_limit' => 1000,
            'bonus' => 25,
            'show_icon' => 1,
            'fbm_bonus_limit' => 100,
            'fbm_bonus' => 25,
            'system_percent' => 3,
            'user_percent' => 2,
            'norm_user_percent_dhl' => 3,
            'vip_user_percent_dhl' => 3,
            'ua_delivery_percent_dhl' => 11,
            'us_delivery_percent_dhl' => 3,
            'by_delivery_percent_dhl' => 12,
            'norm_user_percent_tnt' => 10,
            'vip_user_percent_tnt' => 10,
            'norm_user_percent_fedex' => 7,
            'vip_user_percent_fedex' => 7,
            'negative_balance_days_limit' => 5,
            'negative_balance_limit' => -10,
            'locking_days_limit' => 7,
            'locking_min_amount' => -100,
            'locking_easy_min_amount' => -100,
            'min_days_without_track_number' => 7,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
    }
}
