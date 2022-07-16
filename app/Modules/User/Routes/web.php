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

Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('social.redirect');
Route::get('/auth/{social}/callback', 'SocialAuthController@callback')->name('social.callback');
Route::get('/close_popup', 'SocialAuthController@closePopup')->name('social.closepopup');
Route::post('/login', 'UserController@login')->name('login');
Route::post('/register', 'UserController@register')->name('register');
Route::post('/forgot-password', 'UserController@forgotPassword')->name('users.forgotPassword');

Route::group(['middleware' => 'user'], function () {
    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/profile', 'UserController@profile')->name('users.edit-profile');
    Route::post('/profile', 'UserController@updateProfile')->name('users.update-profile');
    Route::get('/change-password', 'UserController@changePassword')->name('change.password');
    Route::post('change-password', 'UserController@updatePassword')->name('update.password');
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::get('/notifiactions/{notification}/read', 'NotificationController@read')->name('notifications.read');
    Route::post('/notifications/read-all', 'NotificationController@readAll')->name('notifications.read-all');
});

Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
    Route::get('', 'QuestionController@index')->name('index');
    Route::get('/ask', 'QuestionController@askQuestion')->name('ask');
    Route::get('/edit/{question_id}', 'QuestionController@edit')->name('edit');
    Route::delete('/{question_id}/delete', 'QuestionController@destroy')->name('destroy');
    Route::post('/store', 'QuestionController@store')->name('store');
    Route::post('/{question_id}/update', 'QuestionController@update')->name('update');
    Route::get('/get-tags', 'QuestionController@getTag')->name('getTag');
    Route::get('/{question_id}', 'QuestionController@show')->name('detail');
    Route::post('/update-vote', 'QuestionController@updateVote')->name('updateVote');
    Route::get('/tagged/{tag_name}', 'QuestionController@showTag')->name('tag');
    Route::post('{question_id}/bookmark', 'QuestionController@bookmark')->name('bookmark');
});
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('', 'UserController@showList')->name('list');
    Route::get('/{user_id}', 'UserController@detail')->name('profile');
    Route::get('/{user_id}/activity', 'UserController@activity')->name('activity');
    Route::get('/{user_id}/questions', 'UserController@showQuestion')->name('questions');
    Route::get('/{user_id}/following', 'UserController@showFollowing')->name('following');
    Route::get('/{user_id}/answers', 'UserController@showAnswer')->name('answers');
});
Route::resource('answers', 'AnswerController');
Route::post('/{answer_id}/check-best', 'AnswerController@checkBest');
Route::get('/tags', 'TagController@index')->name('tags');
// Route::get('/users', 'UserController@showList')->name('users.list');
Route::get('/', 'HomeController@index')->name('homes.index');
Route::get('/search', 'QuestionController@search')->name('search');
