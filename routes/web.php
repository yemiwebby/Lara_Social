<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//    Route::get('/hello', function () {
//        return Auth::user()->hello();
//    });

    Route::get('/add', function () {
        return App\User::first()->add_friend(2);
    });

    Route::get('/accept', function () {
        return App\User::find(2)->accept_friend(5);
    });

Auth::routes();

Route::get('/home', 'HomeController@index');


// Route for users profile 
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{slug}', [
        'uses' => 'ProfilesController@index',
        'as' => 'profile' 
    ]);

    Route::get('/profile/edit/profile',[
        'uses' => 'ProfilesController@edit',
        'as' => 'profile.edit'
    ]);

    Route::post('/profile/update/profile',[
        'uses' => 'profilesController@update',
        'as' => 'profile.update'
    ]);
});