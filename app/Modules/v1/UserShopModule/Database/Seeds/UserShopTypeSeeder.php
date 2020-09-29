<?php

namespace App\Modules\v1\UserShopModule\Database\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserShopTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'other'],
            ['id' => 2, 'name' => 'etsy'],
            ['id' => 3, 'name' => 'ebay'],
            ['id' => 4, 'name' => 'amazonmws'],
            ['id' => 5, 'name' => 'shopify'],
            ['id' => 6, 'name' => 'opencart'],
            ['id' => 7, 'name' => 'woocommerce'],
            ['id' => 8, 'name' => 'tilda'],
        ];

        $date = Carbon::now()->toDateTimeString();

        foreach ($data as $row) {
            $row['created_at'] = $date;
            $row['updated_at'] = $date;
            DB::table('user_shop_types')->insert($row);
        }

    }
}
