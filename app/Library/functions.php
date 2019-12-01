<?php

use App\GroupUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
//use FCM;

function explodeByComma( $str ) {
    return explode( ",", $str );
}

function explodeByDash( $str ) {
    return explode( "-", $str );
}

function explodeByUnderscore( $str ) {
    return explode( "_", $str );
}

function imgPath($folderName) {

    //عشان ال sub domain  بس هيشها مؤقتا
//    return '/uploads/' . $folderName . '/';
    return '/public/uploads/' . $folderName . '/';
}

function settings() {

    return \App\Setting::where( 'id', 1 )->first();
}

function validateRules($errors, $rules) {

    $error_arr = [];
    $error_arr = "";

    foreach ($rules as $key => $value) {

        if( $errors->get($key) ) {

            $error_arr .= $errors->first($key). " \n ";
//            array_push($error_arr, array('key' => $key, 'value' => $errors->first($key)));
        }
    }

    return $error_arr;
}

function randNumber($length) {

    $seed = str_split('0123456789');

    shuffle($seed);

    $rand = '';

    foreach (array_rand($seed, $length) as $k) $rand .= $seed[$k];

    return $rand;
}

function generateApiToken($userId, $length) {

    $seed = str_split('abcdefghijklmnopqrstuvwxyz' .'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .'0123456789');

    shuffle($seed);

    $rand = '';

    foreach (array_rand($seed, $length) as $k) $rand .= $seed[$k];

    return $userId * $userId . $rand;
}

function UploadBase64Image($base64Str, $prefix, $folderName) {

    $image = base64_decode($base64Str);
    $image_name = $prefix . '_' . time() .'.png';
    $path = public_path( 'uploads' ) . DIRECTORY_SEPARATOR . $folderName . DIRECTORY_SEPARATOR . $image_name;

    $saved = file_put_contents($path, $image);

    return $saved ? $image_name : NULL;
}

function UploadImage( $inputRequest, $prefix, $folderNam ) {

    $imageName = $prefix . '_' . time() .'.' . $inputRequest->getClientOriginalExtension();

    $destinationPath = public_path( '/' . $folderNam );

    $inputRequest->move( $destinationPath, $imageName );

    return $imageName ? $imageName : false;
}
function UploadImageEdit( $inputRequest, $prefix, $folderNam, $oldImage ) {
    @unlink(public_path('/'.$folderNam.'/'.$oldImage));
    $imageName = $prefix . '_' . time() .'.' . $inputRequest->getClientOriginalExtension();

    $destinationPath = public_path( '/' . $folderNam );

    $inputRequest->move( $destinationPath, $imageName );

    return $imageName ? $imageName : false;
}

function getRestaurantAvgRating($ratingsArr)
{
//    $statsSum = $restaurant->ratings()->value(DB::raw("SUM(quality_stars + delivery_stars + packaging_stars + price_stars)"));
//
//    if ($statsSum)
//        return $statsSum / 4;
//    return 0;

    return max($ratingsArr);
}

function getAvgOneRaw($ratingRow)
{
    $sum = $ratingRow->quality_stars + $ratingRow->delivery_stars + $ratingRow->packaging_stars + $ratingRow->price_stars;

    return $sum / 4;
}

function getLocaleType($paymentType)
{
    if ($paymentType == 'visa')
        return ['ar' => 'فيزا', 'en' => 'Visa'];
    elseif ($paymentType == 'cash')
        return ['ar' => 'الدفع عند الاستلام', 'en' => 'Cash On Delivery'];
}

function getLocaleStatus($orderStatus)
{
    if($orderStatus == 0)
        return ['ar' => 'مرفوض', 'en' => 'Rejected'];
    elseif($orderStatus == 1)
        return ['ar' => 'ملغي', 'en' => 'Canceled'];
    elseif($orderStatus == 2)
        return ['ar' => 'قيد الانتظار', 'en' => 'Pending'];
    elseif($orderStatus == 3)
        return ['ar' => 'تم استلام الطلب', 'en' => 'Received'];
    elseif($orderStatus == 4)
        return ['ar' => 'قيد التجهيز', 'en' => 'Preparing'];
    elseif($orderStatus == 5)
        return ['ar' => 'جاري التوصيل', 'en' => 'On The Way'];
    elseif($orderStatus == 6)
        return ['ar' => 'تم التوصيل', 'en' => 'Delivered'];
    elseif($orderStatus == 7)
        return ['ar' => 'جاهز للاستلام', 'en' => 'Ready For Receipting'];
    elseif($orderStatus == 8)
        return ['ar' => 'تم الاستلام', 'en' => 'Receipted'];
    elseif($orderStatus == 9)
        return ['ar' => 'تم الموافقة', 'en' => 'Accepted'];
}

function getDriverStatus($driverStatus)
{
    if($driverStatus == 1)
        return 'مشغول الآن';
    elseif($driverStatus == 2)
        return 'لم يتم الاستجابة بعد';
    elseif($driverStatus == 3)
        return 'حدث مشكلة';
    elseif($driverStatus == 4)
        return 'قيد الاستلام';
    elseif($driverStatus == 5)
        return 'تم التحرك';
    elseif($driverStatus == 6)
        return 'تم تحصيل المبلغ';
}

function getLocaleStatus2($deliveryStatus)
{
    if($deliveryStatus == 3)
        return ['ar' => 'حدث مشكلة', 'en' => 'Problem Occurs'];
    elseif($deliveryStatus == 6)
        return ['ar' => 'تم التوصيل', 'en' => 'Delivered'];
}

function getOrderType($type)
{
    if($type == 'table')
        return ['ar' => 'طاولة', 'en' => 'Table'];
    elseif($type == 'delivery')
        return ['ar' => 'توصيل', 'en' => 'Delivery'];
    elseif($type == 'receipt')
        return ['ar' => 'استلام', 'en' => 'Receipt'];
}

function unReadMessagesCount() {

    return \App\Contact::whereIsRead(false)->count();
}

function unReadNotificationsCount()
{
    return \App\Notification::whereRestaurantId(Auth::guard('restaurant')->user()->id)->whereIsRead(false)->count();
}

function getUnReadNotifications()
{
    return \App\Notification::whereRestaurantId(Auth::guard('restaurant')->user()->id)->whereIsRead(false)->orderBy('id', 'DESC')->get();
}

function siteLanguages()
{
    return [
        'ar' => 'عربي',
        'en' => 'English',
        ];
}

function offersPriceTypes() {
    return [
        'percentage'     => 'نسبة مئوية',
        'fixed'          => 'سعر ثابت',
    ];
}

function getOffersPriceTypes($str) {

    $types = offersPriceTypes();
    foreach ( $types as $key => $value ) {
        if ( $str == $key ) {
            return $value;
        }
    }
    return false;
}

function checkPermissionExists($id, $permissionsIds) {

    return in_array($id, $permissionsIds);
}

function restaurantRatingsStars($rate)
{
    $str = '';
    for ($i = 0; $i < 5; $i++) {
        if ($rate >= $i+1)
            $str .= '<i class="fa fa-star" style="color: #f0c411;"></i>';
        else
            $str .= '<i class="fa fa-star" style="color: #d8d6cf;"></i>';
    }
    return $str;
}

function joinRequestsCount($id)
{
    return User::whereUserType('driver')->whereRestaurantId($id)->whereIsApproved(2)->count();
}

function getAdminOrderTypeCount($statusArr, $type)
{
    return \App\Order::whereIn('status', $statusArr)->whereType($type)->count();
}

function getOrderTypeCount($statusArr, $type)
{
    return \App\Order::whereRestaurantId(Auth::guard('restaurant')->user()->id)->whereIn('status', $statusArr)->whereType($type)->count();
}





function notificationShortcutTypes(){

    return [
        '1' => 'admin',
        '2' => 'order',
        '3' => 'end_order',

    ];
}

function getNotificationType( $typeNum ){

    $types = notificationShortcutTypes();

    foreach ( $types as $key => $value ) {
        if ( $typeNum == $key ) {
            return $value;
        }
    }
}

function genders() {

    return [
        '1' => 'أنثى',
        '2' => 'ذكر'

    ];
}

function getGenderString($char) {

    $genders = genders();
    foreach ( $genders as $key => $value ) {
        if ( $char == $key ) {
            return $value;
        }
    }
}

function targetGenders() {

    return [
        'M' => ['M'],
        'F' => ['F'],
        'B' => ['M', 'F']
    ];
}

function getTargetGenderArr($char) {

    $genders = targetGenders();
    foreach ( $genders as $key => $value ) {
        if ( $char == $key ) {
            return $value;
        }
    }
}

function targetGendersFront() {

    return [
        'M' => 'ذكر',
        'F' => 'أنثى',
        'B' => 'الاثنين معَا'
    ];
}

function getTargetGenderFrontArr($char) {

    $genders = targetGendersFront();
    foreach ( $genders as $key => $value ) {
        if ( $char == $key ) {
            return $value;
        }
    }
}

function ageIntervals() {
    return  [ '10-20', '20-30', '30-40', '40-50', '50-60', '60-70'];
}

function ageUpdatedIntervals() {
//    return  ['undefined', '10-20', '20-30', '30-40', '40-50', '50-60', '60-70'];
    return [
        'undefined' => 'غير محدد',
        '10-20' => '10-20',
        '20-30' => '20-30',
        '30-40' => '30-40',
        '40-50' => '40-50',
        '50-60' => '50-60',
        '60-70' => '60-70'
        ];
}

function getAgeUpdatedIntervals($interval) {

    $ageIntervals = ageUpdatedIntervals();
    foreach ( $ageIntervals as $key => $value ) {
        if ( $interval == $key ) {
            return $value;
        }
    }
}

function getAgeIntervalMinMax($interval) {

    $ageIntervals = ageIntervals();
    foreach ( $ageIntervals as $value ) {
        if ( $interval == $value ) {
            return explodeByDash($value);
        }
    }
}


function getAgeInterval($interval) {

    $ageIntervals = ageIntervals();
    foreach ( $ageIntervals as $value ) {
        if ( $interval == $value ) {
            return $value;
        }
    }
}

function siteImagesTypes() {

    return [
        'slider' => '1',
        'app' => '2'
    ];
}

function getSiteImagesTypes($type) {

    $siteImagesTypes = siteImagesTypes();
    foreach ( $siteImagesTypes as $key => $value ) {
        if ( $type == $key ) {
            return $value;
        }
    }
    return false;
}

function usersTypes() {

    return [
        'admin' => '1',
        'user' => '2',
        'company' => '3'
    ];
}

function getIntUserType($type) {

    $users = usersTypes();
    foreach ( $users as $key => $value ) {
        if ( $type == $key ) {
            return $value;
        }
    }
    return false;
}

function endsWith($string, $finding)
{
    $length = strlen($finding);
    if ($length == 0) {
        return true;
    }
    return (substr($string, -$length) === $finding);
}


function sendNotification($notificationTitle, $notificationBody, $deviceToken) {

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder($notificationTitle);
    $notificationBuilder->setBody($notificationBody)
        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData(['a_data' => 'my_data']);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = $deviceToken;

    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    $downstreamResponse->numberSuccess();
    $downstreamResponse->numberFailure();
    $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
    $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
    $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
    $downstreamResponse->tokensToRetry();

// return Array (key:token, value:errror) - in production you should remove from your database the tokens
}
function sendMultiNotification($notificationTitle, $notificationBody,$allData, $devicesTokens) {

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder($notificationTitle);
    $notificationBuilder->setBody($notificationBody)
        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData($allData);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

// You must change it to get your tokens
    $tokens = $devicesTokens;

    $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

    $downstreamResponse->numberSuccess();
    $downstreamResponse->numberFailure();
    $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
    $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
    $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
    $downstreamResponse->tokensToRetry();

// return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
    $downstreamResponse->tokensWithError();

    return ['success' => $downstreamResponse->numberSuccess(), 'fail' => $downstreamResponse->numberFailure()];
}

function saveNotification($userId, $type, $title, $message,$OrderId) {

    $created = \App\Notification::create(['user_id'=> $userId, 'type'=> $type, 'title'=> $title, 'message'=> $message , 'order_id'=>$OrderId]);
    return $created;
}



function getPendingCount() {

    return GroupUser::groupPendingUsers()->count();
}


