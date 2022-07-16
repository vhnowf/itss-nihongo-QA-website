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

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
    Route::get('/medias', 'MediaController@index')->name('medias.index');
    Route::post('/medias/upload', 'MediaController@upload')->name('medias.upload');
    Route::post('/medias/delete', 'MediaController@delete')->name('medias.delete');
    Route::get('/medias/get-list-month', 'MediaController@getListMonth')->name('medias.getListMonth');
    Route::get('/get-district', 'DistrictController@getDistrict')->name('get-district');
    Route::get('/get-cities', 'CityController@index')->name('get-cities');
    Route::get('/cities/auto-complete', 'CityController@autoComplete')->name('cities.autoComplete');
    Route::get('/users/get-address', 'UserController@getAddress')->name('users.getAddress');
    Route::get('/auto-complete', 'UserController@getKeywordSearch')->name('users.getKeywordSearch');
    Route::get('/emails/create', 'SubscribeEmailController@create')->name('subscribe_emails.create');
    Route::post('/rating-products/create', 'RatingProductController@create')->name('rating_products.create');
});
