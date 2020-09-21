<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $languages = [
            [
                'id' => 1,
                'name' => 'En',
            ],
            [
                'id' => 2,
                'name' => 'Укр',
            ],
            [
                'id' => 3,
                'name' => 'Рус',
            ]
        ];

        foreach ($languages as $language) {
            $language['created_at'] = $date;
            $language['updated_at'] = $date;
            DB::table('languages')->insert($language);
        }

    }
}
