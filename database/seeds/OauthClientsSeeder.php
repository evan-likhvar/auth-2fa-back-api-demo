<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class OauthClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install', [
            '--force' => true,
        ]);
    }
}
