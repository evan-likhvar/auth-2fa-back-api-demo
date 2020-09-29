<?php

use App\Modules\v1\Settings\Database\Seeds\SettingsSeeder;
use App\Modules\v1\Settings\Database\Seeds\ValueTypeSeeder;
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
            UsersSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            ValueTypeSeeder::class,
            SettingsSeeder::class
        ]);
    }
}
