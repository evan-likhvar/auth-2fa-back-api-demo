<?php

use App\Modules\v1\Settings\Database\Seeds\SettingsSeeder;
use App\Modules\v1\Settings\Database\Seeds\ValueTypeSeeder;
use App\Modules\v1\UserShopModule\Database\Seeds\UserShopTypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            \Database\Seeders\LanguagesSeeder::class,
            UsersSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            ValueTypeSeeder::class,
            SettingsSeeder::class,
            OauthClientsSeeder::class,
            UserShopTypeSeeder::class,
        ]);
    }
}
