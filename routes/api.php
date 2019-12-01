<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' =>  'cors'], function () {
    Route::post('login','Api\AuthController@login');
    Route::post('register','Api\AuthController@register');
    Route::post('checkPhone','Api\AuthController@checkPhone');
    Route::get('random','Api\AuthController@createRandomPassword');
    Route::post('verifyPhone','Api\AuthController@verifyPhone');
    Route::post('forgetPasswordDoctor','Api\AuthController@forgetPasswordDoctor');
    Route::post('confirmResetCodeDoctor','Api\AuthController@confirmResetCodeDoctor');
    Route::post('resetPasswordDoctor','Api\AuthController@resetPasswordDoctor');
    Route::post('forgetPasswordUser','Api\AuthController@forgetPasswordUser');
    Route::post('confirmResetCodeUser','Api\AuthController@confirmResetCodeUser');
    Route::post('resetPasswordUser','Api\AuthController@resetPasswordUser');


    Route::post('doctorRequest','Api\AuthController@doctorRequest');

    Route::get('countries','Api\AuthController@countries');
    Route::get('cities/{id}','Api\AuthController@cities');


    //==============================Articles ================================//
    Route::get('main','Api\ArticleController@main');
    Route::get('allArticles','Api\ArticleController@articles');
    Route::get('singleArticle/{id}','Api\ArticleController@singleArticle');

    //==============================End Articles =============================//


    //==============================Doctors ================================//
    Route::get('allDoctors','Api\DoctorController@allDoctors');
    Route::get('doctorDetails/{id}','Api\DoctorController@doctorDetails');

    //==============================End Doctors==============================//


    //==============================Programs ================================//

    Route::get('programDetails/{id}','Api\DoctorController@program_details');

    //==============================End Doctors==============================//

    //==============================Orders ================================//
    Route::get('orderData','Api\OrderController@order_data');
    Route::post('newOrder','Api\OrderController@newOrder');
    Route::get('orderDetails','Api\OrderController@orderDetails');


    //==============================End Orders==============================//


    //==============================About App ================================//
    Route::post('contact','Api\ContactController@contact');
    Route::get('about','Api\AboutController@about');
    Route::get('terms','Api\AboutController@terms');
    Route::get('q_a','Api\AboutController@q_a');

    //=======================================================================//

});
Route::group(['middleware' =>  ['auth:api','cors']], function () {
    Route::post('addOrder','Api\OrderController@add_order');
    Route::get('allUserOrders','Api\OrderController@allOrdersForUser');
    Route::get('allDoctorOrders','Api\OrderController@allOrdersForDoctor');
    Route::get('orderDetails/{id}','Api\OrderController@orderDetails');
    Route::get('statistics','Api\DoctorController@statistics');

    Route::get('orders','Api\OrderController@orders');


    Route::post('addWeight','Api\OrderController@addWeight');
    Route::get('weightHistory','Api\OrderController@weightHistory');


    //Edit profile
    Route::post('checkUserPhone','Api\AuthController@checkUserPhone');
    Route::post('verifyUserPhone','Api\AuthController@verifyUserPhone');

    Route::post('changePassword','Api\AuthController@changePassword');
    Route::post('changeEmail','Api\AuthController@changeEmail');
    Route::post('confirmResetCodeEmail','Api\AuthController@confirmResetCodeEmail');
    Route::get('listNotification','Api\ApiController@listNotifications');
    Route::get('delete_Notifications/{id}','Api\ApiController@delete_Notifications');


    Route::post('uploadImage','Api\AuthController@uploadImage');
});
