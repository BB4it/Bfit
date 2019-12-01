<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//=================================admin panel=========================================

Route::get('/admin/home', ['middleware'=> 'auth:admin', 'uses'=>'AdminController\HomeController@index'])->name('admin.home');
Route::prefix('admin')->group(function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.submit');
    Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Admin\ResetPasswordController@reset')->name('admin.password.update');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');


    // acadmy admin
    Route::group(['middleware'=> ['web','auth:admin']],function(){

        //        ========================settings=======================

        Route::get('setting','AdminController\SettingController@index');
        Route::post('add/settings','AdminController\SettingController@store');
//        Route::get('setting/activeSms','AdminController\SettingController@active_sms');
//        Route::post('add/activeSms','AdminController\SettingController@store_activeSms');


        Route::get('setting/aboutApp','AdminController\SettingController@aboutApp');
        Route::post('add/aboutApp','AdminController\SettingController@store_aboutApp');

        Route::get('setting/conditions_terms','AdminController\SettingController@conditions_terms');
        Route::post('add/conditions_terms','AdminController\SettingController@store_conditions_terms');

        Route::get('setting/questionAnswer','AdminController\SettingController@questionAnswer');
        Route::post('add/questionAnswer','AdminController\SettingController@store_questionAnswer');

        ///////

        Route::get('setting/socialMedia','AdminController\SocialMediaSettingController@index');
        Route::get('add/socialSettings','AdminController\SocialMediaSettingController@create');
        Route::post('add/Social','AdminController\SocialMediaSettingController@store');
        Route::get('edit/social/{id}','AdminController\SocialMediaSettingController@edit');
        Route::post('update/Social/{id}','AdminController\SocialMediaSettingController@update');
        Route::get('delete/{id}/social','AdminController\SocialMediaSettingController@destroy');

        Route::get('setting/pages','AdminController\PageController@index');
        Route::get('add/page','AdminController\PageController@create');
        Route::post('add/page','AdminController\PageController@store');
        Route::get('edit/page/{id}','AdminController\PageController@edit');
        Route::post('update/page/{id}','AdminController\PageController@update');
        Route::get('delete/{id}/page','AdminController\PageController@destroy');

        //main pages
        Route::get('setting/mainPages','AdminController\PageController@main_page_index');
        Route::get('edit/mainpage/{id}','AdminController\PageController@edit_main_page');
        Route::post('update/mainpage/{id}','AdminController\PageController@update_main_page');

        // add links to pages
        Route::get('setting/pageLinks','AdminController\PageController@links_index');
        Route::get('add/link','AdminController\PageController@add_link_page');
        Route::post('add/link','AdminController\PageController@store_link');
        Route::get('edit/link/{id}','AdminController\PageController@edit_link');
        Route::post('update/link/{id}','AdminController\PageController@update_link');
        Route::get('delete/{id}/link','AdminController\PageController@destroy_link');


        //=========================end settings=======================================

        //===========================contacts===========================================
        Route::get('contactUs','AdminController\ContactController@index');
        Route::get('contactUs/show/{id}','AdminController\ContactController@show');
        Route::get('delete/{id}/contact','AdminController\ContactController@destroy');
        Route::get('delete/{id}/contactDetails','AdminController\ContactController@destroy_details');
        Route::post('contact/reply','AdminController\ContactController@replyMessage');

        //===========================end contacts=======================================

        //===========================certificate Orders===========================================
        Route::get('orders','AdminController\OrdersController@orders');
        Route::get('show/order/{id}','AdminController\OrdersController@show');
        Route::get('delete/{id}/order','AdminController\OrdersController@destroy');
        //===========================end certificate Orders=======================================

        //===========================Sports===========================================

        Route::get('sports','AdminController\SportsController@index');
        Route::get('add/sport','AdminController\SportsController@create');
        Route::post('add/sport','AdminController\SportsController@store');
        Route::get('edit/sport/{id}','AdminController\SportsController@edit');
        Route::post('update/sport/{id}','AdminController\SportsController@update');
        Route::get('delete/{id}/sport','AdminController\SportsController@destroy');

        //===========================end Sports=======================================

        // ===========================country and cities===========================================
        Route::get('country','AdminController\CountryController@index');
        Route::get('add/country','AdminController\CountryController@create');
        Route::post('add/country','AdminController\CountryController@store');
        Route::get('edit/country/{id}','AdminController\CountryController@edit');
        Route::post('update/country/{id}','AdminController\CountryController@update');
        Route::get('delete/{id}/country','AdminController\CountryController@destroy');

        Route::get('city','AdminController\CityController@index');
        Route::get('add/city','AdminController\CityController@create');
        Route::post('add/city','AdminController\CityController@store');
        Route::get('edit/city/{id}','AdminController\CityController@edit');
        Route::post('update/city/{id}','AdminController\CityController@update');
        Route::get('delete/{id}/city','AdminController\CityController@destroy');

        //===========================end country and cities=======================================//

        //===========================article===========================================
        Route::get('article','AdminController\ArticleController@index');
        Route::get('add/article','AdminController\ArticleController@create');
        Route::post('add/article','AdminController\ArticleController@store');
        Route::get('edit/article/{id}','AdminController\ArticleController@edit');
        Route::post('update/article/{id}','AdminController\ArticleController@update');
        Route::get('delete/{id}/article','AdminController\ArticleController@destroy');

        //===========================end article=======================================

        // ===========================programs===========================================

        Route::get('programs','AdminController\ProgramController@index');
        Route::get('add/program','AdminController\ProgramController@create');
        Route::post('add/program','AdminController\ProgramController@store');
        Route::get('edit/program/{id}','AdminController\ProgramController@edit');
        Route::post('update/program/{id}','AdminController\ProgramController@update');
        Route::get('delete/{id}/program','AdminController\ProgramController@destroy');

        //===========================end bookReview=======================================

        //===========================bookReview===========================================
        Route::get('slider','AdminController\SliderController@index');
        Route::get('add/slider','AdminController\SliderController@create');
        Route::post('add/slider','AdminController\SliderController@store');
        Route::get('edit/slider/{id}','AdminController\SliderController@edit');
        Route::post('update/slider/{id}','AdminController\SliderController@update');
        Route::get('delete/{id}/slider','AdminController\SliderController@destroy');

        //===========================end bookReview=======================================


        //===========================job===========================================
        Route::prefix('job')->group(function () {
            Route::get('showSection','AdminController\JobController@index_section');
            Route::get('add/section','AdminController\JobController@create_section');
            Route::post('add/section','AdminController\JobController@store_section');
            Route::get('edit/section/{id}','AdminController\JobController@edit_section');
            Route::post('update/section/{id}','AdminController\JobController@update_section');
            Route::get('delete/{id}/section','AdminController\JobController@destroy_section');


            Route::get('showJob','AdminController\JobController@index_job');
            Route::get('add/job','AdminController\JobController@create_job');
            Route::post('add/job','AdminController\JobController@store_job');
            Route::get('edit/job/{id}','AdminController\JobController@edit_job');
            Route::post('update/job/{id}','AdminController\JobController@update_job');
            Route::get('delete/{id}/job','AdminController\JobController@destroy_job');
        });
        //        ===========================end job=======================================

        //        ===========================interactiveIcons===========================================

        Route::get('interactiveIcons','AdminController\InteractiveIconsController@index');
        Route::get('add/interactiveIcons','AdminController\InteractiveIconsController@create');
        Route::post('add/interactiveIcons','AdminController\InteractiveIconsController@store');
        Route::get('edit/interactiveIcons/{id}','AdminController\InteractiveIconsController@edit');
        Route::post('update/interactiveIcons/{id}','AdminController\InteractiveIconsController@update');
        Route::get('delete/{id}/interactiveIcons','AdminController\InteractiveIconsController@destroy');

        //===========================end interactiveIcons=======================================


        // ===========================users===========================================

        //  users
        Route::group(['middleware'=> ['web','auth:admin']],function(){
            Route::get('user/{id}','AdminController\UserController@index');
            Route::get('add/user/{type}','AdminController\UserController@create');
            Route::post('add/user/{type}','AdminController\UserController@store');
            Route::get('edit/user/{id}/{type}','AdminController\UserController@edit');
            Route::post('update/user/{idedit/city}/{type}','AdminController\UserController@update');
            //
            Route::get('show/user/{id}/{type}','AdminController\UserController@show');
            //
            Route::post('update/pass/{id}','AdminController\UserController@update_pass');
            Route::post('update/privacy/{id}','AdminController\UserController@update_privacy');
            Route::get('delete/{id}/user','AdminController\UserController@destroy');

            Route::get('get/cities/{id}','AdminController\UserController@get_cities');

            Route::get('emptyWallet/user/{id}','AdminController\UserController@emptyWallet');
            Route::get('doctorDetails/{id}','AdminController\UserController@doctorDetails');
            Route::get('doctorPrograms/{id}','AdminController\UserController@doctorPrograms');
            Route::get('doctorOrders/{id}','AdminController\UserController@doctorOrders');
            Route::get('userDetails/{id}','AdminController\UserController@userDetails');
            Route::get('userOrders/{id}','AdminController\UserController@userOrders');
            Route::get('programDetails/{id}','AdminController\UserController@programDetails');
            Route::get('userWeight/{id}','AdminController\UserController@userWeight');



            Route::get('/notifications/{type}', [
                'uses' => 'AdminController\NotificationController@create',
                'as' => 'notifications.create',
            ]);

            Route::post('/notifications/{type}', [
                'uses' => 'AdminController\NotificationController@store',
                'as' => 'notifications.store',
            ]);

        });

        //        ===========================end users=======================================
        // ===========================courses===========================================

        Route::group(['middleware'=> ['web','auth:admin']],function(){

            Route::get('doctorRequest','AdminController\DoctorRequestController@index');
            Route::get('doctorRequest/show/{id}','AdminController\DoctorRequestController@show');
            Route::get('doctorRequest/delete/{id}','AdminController\DoctorRequestController@destroy');

        });

//        ===========================end courses=======================================


    });

    Route::group(['middleware'=> ['web','auth:admin']],function(){
        // Roles Route
        Route::resource('roles', 'AdminController\RoleController');
        Route::get('/roles_members/{id}', [
            'uses' => 'AdminController\RoleController@roles_members',
            'as' => 'roles_members' // name
        ]);
        Route::get('/delete_group/{id}', [
            'uses' => 'AdminController\RoleController@destroy',
            'as' => 'delete_group' // name
        ]);
        //    Route::get('/add_admin_group/{id}', [
        //        'uses' => 'RoleController@add_admin_group',
        //        'as' => 'add_admin_group' // name
        //    ]);
        //    Route::post('/add_admin', [
        //        'uses' => 'RoleController@add_admin',
        //        'as' => 'add_admin' // name
        //    ]);
        Route::patch('/update_permission/{id}', [
            'uses' => 'AdminController\RoleController@update_permission',
            'as' => 'update_permission' // name
        ]);



        // Admins Route
        Route::resource('admins', 'AdminController\AdminController');

        Route::get('/profile', [
            'uses' => 'AdminController\AdminController@my_profile',
            'as' => 'my_profile' // name
        ]);
        Route::post('/profileEdit', [
            'uses' => 'AdminController\AdminController@my_profile_edit',
            'as' => 'my_profile_edit' // name
        ]);
        Route::get('/profileChangePass', [
            'uses' => 'AdminController\AdminController@change_pass',
            'as' => 'change_pass' // name
        ]);
        Route::post('/profileChangePass', [
            'uses' => 'AdminController\AdminController@change_pass_update',
            'as' => 'change_pass' // name
        ]);

        Route::get('/admin_delete/{id}', [
            'uses' => 'AdminController\AdminController@admin_delete',
            'as' => 'admin_delete' // name
        ]);
        Route::get('/show_permissions/{id}', [
            'uses' => 'AdminController\AdminController@show_permissions',
            'as' => 'show_permissions' // name
        ]);
        Route::patch('/update_admin_permission/{id}', [
            'uses' => 'AdminController\AdminController@update_admin_permission',
            'as' => 'update_admin_permission' // name
        ]);
    });
});
//=================================end admin panel ==================================