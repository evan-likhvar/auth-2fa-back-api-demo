<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shops', function (Blueprint $table) {
            $table->id();
            $table->string('oauth_token', 255)->nullable();
            $table->string('oauth_token_secret', 100)->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('shop_type_id')->index();
            $table->boolean('create_from_admin')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('used')->default(0);
            $table->boolean('default')->default(0);
            $table->unsignedTinyInteger('status')->default(2);
            $table->boolean('verified')->default(1);
            $table->string('email', 128)->nullable();
            $table->string('ga_view_id', 128)->nullable();
            $table->text('ga_service_account_key_text')->nullable();
            $table->string('remote_shop_id', 255)->nullable();
            $table->string('remote_shop_url', 255)->nullable();
            $table->string('remote_shop_api_key', 255)->nullable();
            $table->string('remote_shop_api_secret', 255)->nullable();
            $table->string('shop_link', 255)->nullable();
            $table->string('shop_login', 255)->nullable();
            $table->string('shop_password', 255)->nullable();
            $table->text('admin_comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id', 'user_shops_to_user_ref')->on('users')
                ->references('id')->onUpdate('cascade')->onDelete('cascade');;

            $table->foreign('shop_type_id', 'user_shops_to_user_shop_type_ref')->on('user_shop_types')
                ->references('id')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shops');
    }
}
