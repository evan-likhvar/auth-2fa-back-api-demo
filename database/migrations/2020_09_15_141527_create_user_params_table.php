<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserParamsTable extends Migration
{
    public function up()
    {
        Schema::create('user_params', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('google_reset_codes', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 20)->nullable();

//            $table->string('username');
//            $table->string('username_canonical')->nullable();
//            $table->string('email')->unique();
//            $table->string('email_canonical')->unique()->nullable();
//            $table->tinyInteger('enabled')->nullable();
//            $table->string('salt');
//            $table->string('password');
//            $table->timestamp('last_login')->nullable();
//            $table->tinyInteger('locked')->nullable();
//            $table->tinyInteger('expired')->nullable();
//            $table->timestamp('expires_at')->nullable();
//            $table->string('confirmation_token')->nullable();
//            $table->timestamp('password_requested_at')->nullable();
//            $table->integer('send_approve_mail')->nullable();
//            $table->string('nickname', 512)->nullable();
//            $table->string('first_name', 512)->nullable();
//            $table->string('last_name', 512)->nullable();
//            $table->date('birthday')->nullable();
//            $table->longText('about')->nullable();
//            $table->string('skype', 512)->nullable();
//            $table->longText('street')->nullable();
//            $table->longText('flat')->nullable();
//            $table->longText('avatar')->nullable();
//            $table->longText('document')->nullable();
//            $table->longText('document_number')->nullable();
//            $table->longText('document_issued_by')->nullable();
//            $table->integer('document_type')->nullable();
//            $table->double('balance')->nullable();
//            $table->tinyInteger('confirmed')->nullable();
//            $table->longText('permission_string')->nullable();
//            $table->integer('up_id')->nullable();
//            $table->integer('interest_rate')->default(-1);

//            $table->bigInteger('parent_user')
//                ->unsigned()
//                ->nullable()
//                ->index();

//            $table->foreign('parent_user')
//                ->references('id')
//                ->on('user_params')
//                ->onDelete('SET NULL');

//            $table->string('partner_code')->nullable();
//
//            $table->tinyInteger('added_bonus')
//                ->nullable()
//                ->default(0);
//
//            $table->double('parent_bonus')
//                ->nullable()
//                ->default(0);

//            $table->integer('count_visit')
//                ->nullable()
//                ->default(0);
//
//            $table->double('all_balance')
//                ->nullable()
//                ->default(0);
//
//            $table->double('degree_customers')
//                ->nullable();

            $table->longText('logo_invoice')->nullable();

            $table->tinyInteger('ff_by_amazon')
                ->nullable()
                ->default(0);

            $table->tinyInteger('ff_by_merchant')
                ->nullable()
                ->default(0);

            $table->tinyInteger('sms_verify')
                ->nullable()
                ->default(0);

            $table->string('sms_verify_code')->nullable();

            $table->tinyInteger('send_email_transction')
                ->nullable()
                ->default(1);

            $table->tinyInteger('send_email_shipment')
                ->nullable()
                ->default(1);

            $table->tinyInteger('send_email_orders')
                ->nullable()
                ->default(1);

            $table->tinyInteger('send_email_from_admin')
                ->nullable()
                ->default(1);

            $table->double('bonus_balance')->nullable();

//            $table->tinyInteger('vip')
//                ->nullable()
//                ->default(0);

            $table->tinyInteger('allow_dhl')
                ->nullable()
                ->default(0);

            $table->longText('user_history')->nullable();
            $table->longText('shop_logo')->nullable();
            $table->longText('shop_name')->nullable();
            $table->longText('shop_description')->nullable();

//            $table->bigInteger('parent_user_id')
//                ->unsigned()
//                ->nullable()
//                ->index();

//            $table->foreign('parent_user_id')
//                ->references('id')
//                ->on('user_params')
//                ->onDelete('SET NULL');

            $table->double('sklad_fee')
                ->nullable()
                ->default(0);

            $table->tinyInteger('use_shipstation')
                ->nullable()
                ->default(0);

            $table->bigInteger('order_price_id')
                ->nullable()
                ->index();

            $table->tinyInteger('ukrpochta')
                ->nullable()
                ->default(0);

            $table->tinyInteger('send_sms')
                ->nullable()
                ->default(1);

            $table->tinyInteger('send_email')
                ->nullable()
                ->default(0);

            $table->tinyInteger('allow_dhl_no_tr')
                ->nullable()
                ->default(0);

            $table->string('order_price_str')->nullable();

            $table->tinyInteger('use_bankomat')
                ->nullable()
                ->default(0);

            $table->string('max_summ_bankomat')
                ->nullable()
                ->default('500');

            $table->string('max_per_week_bankomat')
                ->nullable()
                ->default('7');

            $table->string('max_per_day_bankomat')
                ->nullable()
                ->default('1');

            $table->string('max_procent_sum_bankomat')
                ->nullable()
                ->default('50');

            $table->tinyInteger('can_archive')->default(1);

            $table->tinyInteger('use_autorize')
                ->nullable()
                ->default(0);

            $table->tinyInteger('send_trak_num_to_etsy')
                ->nullable()
                ->default(1);

            $table->tinyInteger('use_google_auth')
                ->nullable()
                ->default(0);

            //$table->string('google_authenticator_code', 16)->nullable();

            $table->tinyInteger('use_easypost')
                ->nullable()
                ->default(0);

            $table->tinyInteger('can_refund_paypal_transactions')
                ->nullable()
                ->default(0);

            $table->string('max_sum_refund_paypal_transactions', 500)->nullable();
            $table->string('max_per_week_refund_paypal_transactions', 7)->nullable();
            $table->string('max_per_day_refund_paypal_transactions', 1)->nullable();
            $table->string('max_percent_refund_paypal_transactions', 50)->nullable();

            $table->tinyInteger('send_product_to_sklad')
                ->nullable()
                ->default(1);

            $table->string('facebook_id', 512)->nullable();

            $table->tinyInteger('use_liqpay')
                ->nullable()
                ->default(0);

            $table->tinyInteger('checked')
                ->nullable();

            $table->tinyInteger('send_trak_num_to_amazone')
                ->nullable()
                ->default(1);

            $table->tinyInteger('use_easycabinet')
                ->nullable()
                ->default(0);

            $table->tinyInteger('send_trak_num_to_ebay')
                ->nullable()
                ->default(1);

            $table->tinyInteger('dont_blocked')
                ->nullable()
                ->default(0);

            $table->tinyInteger('use_out_without_tracking')
                ->nullable()
                ->default(0);

            $table->tinyInteger('use_pay_pal')
                ->nullable()
                ->default(0);

            $table->string('fresh_chat_restore_id', 256)->nullable();
            $table->string('new_post_address', 512)->nullable();

            $table->tinyInteger('use_fedex')
                ->nullable()
                ->default(0);

            $table->tinyInteger('admin_permission_google_auth')
                ->nullable()
                ->default(0);

            $table->tinyInteger('allow_tnt')
                ->nullable()
                ->default(0);

            $table->tinyInteger('allow_tnt_no_tr')
                ->nullable()
                ->default(0);

            $table->tinyInteger('use_tnt')
                ->nullable()
                ->default(0);

            $table->double('ref_fee')
                ->nullable()
                ->default(0);

            $table->tinyInteger('use_quick_registration')
                ->nullable()
                ->default(0);

            $table->integer('min_days_transact_note')->default(7);

            $table->tinyInteger('show_ebay_token_error')
                ->nullable()
                ->default(0);

            $table->timestamp('ship_station_label_date_created')->nullable();
            $table->timestamp('ship_station_label_date')->nullable();

            $table->string('full_name', 512)->nullable();
            $table->string('email_additional')->nullable();

            $table->tinyInteger('send_etsy_email')
                ->nullable()
                ->default(0);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_params');
    }
}
