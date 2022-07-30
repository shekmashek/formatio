<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Auth\AuthController@login')->name('login');
Route::post('register', 'Auth\AuthController@inscription')->name('register');
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('logout', 'Auth\AuthController@logout');
    Route::get('user', 'Auth\AuthController@user');
});

Route::get('profil/{id}', 'Api\HomeController@profil')->name('profil');
Route::get('liste_collaborateur/{id}','Api\HomeController@liste_collaborateur')->name('liste_collaborateur');
Route::get('liste_projet/{id}','Api\HomeController@liste_projet')->name('liste_projet');