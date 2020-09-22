<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserParam
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $username_canonical
 * @property string|null $email_canonical
 * @property int|null $enabled
 * @property int|null $locked
 * @property int|null $expired
 * @property string|null $expires_at
 * @property string|null $nickname
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $birthday
 * @property string|null $about
 * @property string|null $skype
 * @property string|null $phone
 * @property string|null $house_number
 * @property string|null $street
 * @property string|null $flat
 * @property string|null $city
 * @property string|null $region
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $avatar
 * @property string|null $document
 * @property string|null $document_number
 * @property string|null $document_issued_by
 * @property int|null $document_type
 * @property float|null $balance
 * @property int|null $up_id
 * @property int $interest_rate
 * @property string|null $logo_invoice
 * @property int|null $ff_by_amazon
 * @property int|null $ff_by_merchant
 * @property int|null $sms_verify
 * @property string|null $sms_verify_code
 * @property int|null $send_email_transction
 * @property int|null $send_email_shipment
 * @property int|null $send_email_orders
 * @property int|null $send_email_from_admin
 * @property float|null $bonus_balance
 * @property int|null $allow_dhl
 * @property string|null $user_history
 * @property string|null $shop_logo
 * @property string|null $shop_name
 * @property string|null $shop_description
 * @property float|null $sklad_fee
 * @property int|null $use_shipstation
 * @property int|null $order_price_id
 * @property int|null $ukrpochta
 * @property int|null $send_sms
 * @property int|null $send_email
 * @property int|null $allow_dhl_no_tr
 * @property string|null $order_price_str
 * @property int|null $use_bankomat
 * @property string|null $max_summ_bankomat
 * @property string|null $max_per_week_bankomat
 * @property string|null $max_per_day_bankomat
 * @property string|null $max_procent_sum_bankomat
 * @property int $can_archive
 * @property int|null $use_autorize
 * @property int|null $send_trak_num_to_etsy
 * @property int|null $use_google_auth
 * @property string|null $google_authenticator_code
 * @property string|null $google_reset_codes
 * @property int|null $use_easypost
 * @property int|null $can_refund_paypal_transactions
 * @property string|null $max_sum_refund_paypal_transactions
 * @property string|null $max_per_week_refund_paypal_transactions
 * @property string|null $max_per_day_refund_paypal_transactions
 * @property string|null $max_percent_refund_paypal_transactions
 * @property int|null $send_product_to_sklad
 * @property string|null $facebook_id
 * @property int|null $use_liqpay
 * @property int|null $checked
 * @property int|null $send_trak_num_to_amazone
 * @property int|null $use_easycabinet
 * @property int|null $send_trak_num_to_ebay
 * @property int|null $dont_blocked
 * @property int|null $use_out_without_tracking
 * @property int|null $use_pay_pal
 * @property string|null $fresh_chat_restore_id
 * @property string|null $new_post_address
 * @property int|null $use_fedex
 * @property int|null $admin_permission_google_auth
 * @property int|null $allow_tnt
 * @property int|null $allow_tnt_no_tr
 * @property int|null $use_tnt
 * @property float|null $ref_fee
 * @property int|null $use_quick_registration
 * @property int $min_days_transact_note
 * @property int|null $show_ebay_token_error
 * @property string|null $ship_station_label_date_created
 * @property string|null $ship_station_label_date
 * @property string|null $full_name
 * @property string|null $email_additional
 * @property int|null $send_etsy_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAdminPermissionGoogleAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAllowDhl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAllowDhlNoTr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAllowTnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAllowTntNoTr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereBonusBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereCanArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereCanRefundPaypalTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereDocumentIssuedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereDontBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereEmailAdditional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereEmailCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFfByAmazon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFfByMerchant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFreshChatRestoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereGoogleAuthenticatorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereGoogleResetCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereInterestRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereLogoInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxPerDayBankomat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxPerDayRefundPaypalTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxPerWeekBankomat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxPerWeekRefundPaypalTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxPercentRefundPaypalTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxProcentSumBankomat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxSumRefundPaypalTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMaxSummBankomat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereMinDaysTransactNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereNewPostAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereOrderPriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereOrderPriceStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereRefFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendEmailFromAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendEmailOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendEmailShipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendEmailTransction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendEtsyEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendProductToSklad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendTrakNumToAmazone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendTrakNumToEbay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSendTrakNumToEtsy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereShipStationLabelDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereShipStationLabelDateCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereShopDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereShopLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereShowEbayTokenError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSkladFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSmsVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereSmsVerifyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUkrpochta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseAutorize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseBankomat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseEasycabinet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseEasypost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseFedex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseGoogleAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseLiqpay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseOutWithoutTracking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUsePayPal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseQuickRegistration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseShipstation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUseTnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUserHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserParam whereUsernameCanonical($value)
 * @mixin \Eloquent
 */
class UserParam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'region',
        'country',
        'postal_code',
        ];
}
