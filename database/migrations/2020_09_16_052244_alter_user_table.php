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
            $table->unsignedBigInteger('language_id')->index()->default(1)->after('parent_id');
            $table->boolean('is_vip')->default(0)->after('email');
            $table->timestamp('last_login')->nullable()->after('is_vip');
            $table->string('last_name')->default('')->after('name');
            $table->tinyInteger('google2fa_enable')->nullable()->default(0);
            $table->string('google2fa_secret',100)->nullable();
            $table->string('google2fa_login_otp',50)->nullable();
            $table->dateTime('google2fa_login_at')->nullable();

            $table->foreign('language_id')->references('id')->on('languages');
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
