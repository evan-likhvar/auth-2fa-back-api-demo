<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();
            $table->text('value')->default(null)->nullable();
            $table->text('default_value')->default(null)->nullable();
            $table->string('description')->default(null)->nullable();
            $table->bigInteger('type_id')->unsigned()->comment('Тип значения');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id', 'settings_to_value_types_foreign_key')->references('id')->on('value_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign('settings_to_value_types_foreign_key');
        });

        Schema::dropIfExists('settings');
    }
}
