<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->index()->nullable()->after('id');
            $table->boolean('is_vip')->nullable()->default(0)->after('email');
            $table->timestamp('last_login')->nullable()->after('is_vip');
            $table->tinyInteger('sms_verify')->nullable()->default(0);
            $table->string('sms_verify_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
