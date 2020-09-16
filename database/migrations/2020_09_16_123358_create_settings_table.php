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
            $table->integer('interest_rate')->nullable(false)->index()->comment('Процентная ставка');
            $table->integer('dashboard_period')->nullable(false)->index()->comment('Период отображение информации в Информационной панели');
            $table->double('bonus_limit')->default(1000)->nullable(false)->index()->comment('Бонусный лимит');
            $table->double('bonus')->default(25)->nullable(false)->index()->comment('Количество бонусов');
            $table->enum('show_icon', [0, 1])->default(0)->index();

            //Бонус за FBM
            $table->double('fbm_bonus_limit')->default(1000)->nullable(false)->index()->comment('Реферал потратил на оплату инвойсов FBM');
            $table->double('fbm_bonus')->default(25)->nullable(false)->index()->comment('Рефер получит на баланс');

            //Управление процентными ставками по умолчанию
            $table->double('system_percent')->default(3)->nullable(false)->index()->comment('Процент коммисия системы в % от общей суммы транзакции');
            $table->double('user_percent')->default(2)->nullable(false)->index()->comment('Процент что уходит на бонусный счет пользователя в % от общей суммы транзакции');

            //Управление наценкой на стоимость доставки DHL
            $table->double('norm_user_percent_dhl')->default(15)->nullable(false)->index()->comment('Процент добавление на цену доставки для обычных пользователей');
            $table->double('vip_user_percent_dhl')->default(15)->nullable(false)->index()->comment('Процент добавление на цену доставки для VIP пользователей');

            //Управление наценкой на стоимость доставки DHL(В засимости от счета)
            $table->double('ua_delivery_percent_dhl')->default(15)->nullable(false)->index()->comment('Для Украинского счета');
            $table->double('us_delivery_percent_dhl')->default(15)->nullable(false)->index()->comment('Для Американского счета');
            $table->double('by_delivery_percent_dhl')->default(15)->nullable(false)->index()->comment('Для Белоруского счета');

            //Управление наценкой на стоимость доставки TNT(В засимости от счета)
            $table->double('norm_user_percent_tnt')->default(15)->nullable(false)->index()->comment('Процент наценки для обычных пользователей');
            $table->double('vip_user_percent_tnt')->default(15)->nullable(false)->index()->comment('Процент наценки для VIP');

            //Управление наценкой на стоимость доставки Fedex(В засимости от счета)
            $table->double('norm_user_percent_fedex')->default(15)->nullable(false)->index()->comment('Процент наценки для обычных пользователей');
            $table->double('vip_user_percent_fedex')->default(15)->nullable(false)->index()->comment('Процент наценки для VIP');

            //Механизм для клиенов в минусе
            $table->integer('negative_balance_days_limit')->default(5)->nullable(false)->index()->comment('Колличество дней');
            $table->double('negative_balance_limit')->default(10)->nullable(false)->index()->comment('Сумма меньше которой выдавать сообщение');

            //Настройки блокировки пользователей
            $table->integer('locking_days_limit')->default(14)->nullable(false)->index()->comment('Колличество дней которое баланс в минусе');
            $table->double('locking_min_amount')->default(-20)->nullable(false)->index()->comment('Минимальная сумма для блокировки');
            $table->double('locking_easy_min_amount')->default(-0.5)->nullable(false)->index()->comment('Минимальная сумма для блокировки Упрощеного функционала');

            //Напоминание для транзакций
            $table->integer('min_days_without_track_number')->default(7)->nullable(false)->index()->comment('Дней для транзакций без трекномера');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
