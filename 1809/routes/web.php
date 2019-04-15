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
Route::get('/info', function () {
    phpinfo();
});
//Route::get('/Weixin/valid','WxController@valid');
Route::get('/Wx/get_Access_Token','WxController@getAccessToken');
Route::get('/Wx/valid','WxController@valid');
Route::post('/Wx/valid','WxController@wxEvent');
Route::get('/user','UserController@user');
Route::get('/test','WxController@test');