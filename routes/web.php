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



// ユーザー登録

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get'); // ユーザー登録フォーム
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post'); // ユーザー登録処理のルーティング

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');



// ユーザー一覧のルーティング ログインしているときのみ
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
});



// rooms のルーティング
Route::resource('rooms', 'RoomsController');

// placeのルーティング
Route::delete('rooms/{id}/{place_id}', 'PlacesController@destroy')->name('places.destroy');
Route::get('rooms/{id}/create', 'PlacesController@create')->name('places.create');
Route::post('rooms/{id}/store', 'PlacesController@store')->name('places.store');
Route::get('rooms/{id}/{place_id}/edit', 'PlacesController@edit')->name('places.edit');
Route::put('rooms/{id}/{place_id}', 'PlacesController@update')->name('places.update');
Route::get('rooms/{id}/{place_id}', 'PlacesController@show')->name('places.show');

// place_detailのルーティング
// Route::delete('rooms/{id}/{place_id}/{place_detail_id}', 'PlaceDetailsController@destroy')->name('place_details.destroy');
// Route::get('rooms/{id}/create', 'PlaceDetailsController@create')->name('place_details.create');
// Route::post('rooms/{id}/store', 'PlaceDetailsController@store')->name('place_details.store');
// Route::get('rooms/{id}/{place_id}/edit', 'PlaceDetailsController@edit')->name('place_details.edit');
// Route::put('rooms/{id}/{place_id}', 'PlaceDetailsController@update')->name('place_details.update');
Route::get('rooms/{id}/{place_id}/{place_detail_id}', 'PlaceDetailsController@show')->name('place_details.show');




// create: 新規作成用のフォームページ

// edit: 更新用のフォームページ
