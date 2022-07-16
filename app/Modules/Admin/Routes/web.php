<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('setLocal/{language}', function ($lang) {
    \Session::put('lang-admin', $lang);

    return back();
})->name('admin.setLocal');

Route::group(['middleware' => 'locale-admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', 'AdminController@login');
    Route::post('login', 'AdminController@signIn')->name('login');

    Route::group(['middleware' => 'admin'], function () {
        Route::resource('posts', 'QuestionController');

        Route::get('logout', 'AdminController@logout')->name('logout');
        Route::get('/change-password', 'AdminController@changePassword')->name('changePassword');
        Route::post('/update-password', 'AdminController@updatePassword')->name('updatePassword');
        Route::get('/', 'DashboardController@index')->name('dashboards.index');

        Route::resource('admins', 'AdminController');

        Route::resource('users', 'UserController');
        Route::get('/users/{user}/lock', 'UserController@lock')->name('users.lock');
        Route::get('/users/{user}/unlock', 'UserController@unlock')->name('users.unlock');
    });
});
