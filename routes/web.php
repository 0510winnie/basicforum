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

Route::get('/','StaticPagesController@home')->name('home');

Route::get('signup', 'UserController@create')->name('signup');
Route::get('signup/confirm/{token}','UserController@confirmEmail')->name('confirm_email');
Route::resource('users','UserController');
Route::resource('statuses','StatusesController',['only'=>['store','destroy']]);

Route::get('login', 'SessionsController@create')->name('login');
// 顯上登入頁面
Route::post('login', 'SessionsController@store')->name('login');
// 創建新會話（登入）
//我們在前面新增的路由中，有兩个路由的命名完全一致，
//但由於我們在表單中清楚的指明了使用 POST 動作來提交用户的登入信息，
//因此 Laravel 會自動將該请求映射到會話控制器的 store 動作上。

Route::delete('logout', 'SessionsController@destroy')->name('logout');
// 銷毀會話（退出登入）

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//顯示重置密碼的郵件發送頁面
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//郵箱發送重設連結
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
//密碼更新頁面
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
//執行密碼更新操作

Route::get('/users/{user}/followings', 'UserController@followings')->name('users.followings');
//顯示用戶的關注人列表
Route::get('/users/{user}/followers','UserController@followers')->name('users.followers');
//顯示用戶的的粉絲列表
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
//關注用戶
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
//取消關注