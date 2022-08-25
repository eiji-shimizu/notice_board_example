<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('noticeboard')->middleware(['auth'])->group(function () {

    Route::get('top', function () {
        return view('top');
    });


    /**
     * 各WebAPI 外部からのアクセスを想定していないものはこのファイル内でルーティングする
     */

    // 単語を取得する
    Route::get('words/{key}', 'App\Http\Controllers\WordsController@get');

    // ログインユーザー情報を取得する
    Route::get('userInfo', 'App\Http\Controllers\UserController@getLoginUserInfo');

    // 投稿
    Route::post('addItem', 'App\Http\Controllers\ItemController@addItem');

    // 投稿データ取得
    Route::get('getItems', 'App\Http\Controllers\ItemController@getItems');

    // 投稿画像取得
    Route::get('getImage/{key}', 'App\Http\Controllers\ItemController@getImage');


    // Route::get('/register', function () {
    //     return view('register');
    // });

    // Route::post('/add', [App\Http\Controllers\UserController::class, 'register']);
    // Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
});
