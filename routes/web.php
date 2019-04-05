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
Route::get('/test','IndexController@test');
Route::get('/down2/{mulu}/{num}/{name}','IndexController@preg_image2');
Route::get('/down1/{mulu}/{num}/{name}','IndexController@preg_image1');
Route::get('/','IndexController@index');
Route::get('detail/{id}','IndexController@detail');
Route::get('cartoon/{id}/{list_id}','IndexController@cartoon');
Route::get('list/{id}','IndexController@cartoon_list');
Route::get('cate','IndexController@cate');
//书签
Route::get('bookcase','IndexController@bookcase');
//热搜榜
Route::get('poplist','IndexController@poplist');





/**
 * my我的
 */
Route::get('my','UserController@my');
//充值页面
Route::get('recharge','UserController@recharge')->middleware('checklogin');
//修改密码页面
Route::get('password','UserController@password')->middleware('checklogin');
Route::post('changePassword','UserController@changePassword');
//留言页面
Route::get('message','UserController@message')->middleware('checklogin');
//留言功能
Route::post('message','UserController@message')->middleware('checklogin');
//签到功能
Route::post('user/sign','SignController@userSign')->middleware('checklogin');
//分享功能
Route::get('url/share','ShareController@getShareUrl')->middleware('checklogin');
//账单详情
Route::get('bill/detail','UserController@billDetail')->middleware('checklogin');





/**
 * 登陆注册
 */

Route::get('login','LoginController@login');
Route::get('reg','LoginController@reg');
Route::post('doLogin','LoginController@doLogin');
Route::post('doReg','LoginController@doReg');

//注销
Route::post('logOut','LoginController@logOut');



//漫画

Route::get('addCollect','CartoonController@addCollect');

Route::post('delCollect','CartoonController@delCollect');



//支付
Route::post('payy','PayController@pay');
Route::get('pay/dk/notify_url','PayController@notify_url');
Route::get('pay/dk/return_url','PayController@return_url');




