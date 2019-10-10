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

Route::group(['prefix' => 'v1'], function () {
    Route::get('/test', 'UserController@test');

    Route::resource('/users', 'UserController');
    Route::get('/users/follow/{user_id}', 'UserController@follow');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/me', 'UserController@me');

        Route::resource('/addresses', 'AddressController');
        Route::resource('/posts', 'PostController');
        Route::get('/like/{feed_id}', 'LikeController@like');
        Route::get('/like/bylocation/{address_id}', 'LikeController@mostLikesByLocation');
    });
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
