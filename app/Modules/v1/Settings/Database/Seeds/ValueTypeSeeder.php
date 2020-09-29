<?php

namespace App\Modules\v1\Settings\Database\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('value_types')->insert([
            'id' => 1,
            'value_name' => 'integer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 2,
            'value_name' => 'boolean',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 3,
            'value_name' => 'float',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 4,
            'value_name' => 'double',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 5,
            'value_name' => 'string',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 6,
            'value_name' => 'array',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 7,
            'value_name' => 'object',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 8,
            'value_name' => 'resource',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
        DB::table('value_types')->insert([
            'id' => 9,
            'value_name' => 'NULL',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
    }
}
