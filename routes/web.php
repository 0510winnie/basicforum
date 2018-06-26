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

Route::get('login', 'SessionsController@create')->name('login');
// 显示登录页面
Route::post('login', 'SessionsController@store')->name('login');
// 创建新会话（登录）
//我们在前面新增的路由中，有两个路由的命名完全一致，
//但由于我们在表单中清楚的指明了使用 POST 动作来提交用户的登录信息，
//因此 Laravel 会自动将该请求映射到会话控制器的 store 动作上。

Route::delete('logout', 'SessionsController@destroy')->name('logout');
// 销毁会话（退出登录）


