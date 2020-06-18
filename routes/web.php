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

Route::get('/', function(){
	return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['can:isMember', 'auth', 'verified']], function() {
	Route::get('/awards', 'AwardController@index')->name('awards');
	Route::get('/profile', 'ProfileController@index');
	Route::put('/profile', 'ProfileController@update')->name('profile');
	Route::get('/upload', 'UploadController@index')->name('upload');
   Route::post('/upload', 'UploadController@store')->name('upload');
});

Route::group(['middleware' => ['can:isAdmin', 'auth']], function () {

	Route::get('admin', 'Admin\AdminController@index')->name('admin');
   	// admin award
   	Route::get('admin/awards', 'Admin\AwardController@index')->name('admin/awards');
   	Route::get('admin/award/tambah', 'Admin\AwardController@create')->name('admin/award-tambah');
   	Route::post('admin/award/tambah', 'Admin\AwardController@store')->name('admin/award-tambah');
   	Route::get('admin/award/ubah/{uuid}', 'Admin\AwardController@edit');
   	Route::put('admin/award/ubah/{uuid}', 'Admin\AwardController@update');
   	Route::get('admin/award/hapus/{id}', 'Admin\AwardController@destroy');

   	// admin member
   	Route::get('admin/members', 'Admin\MemberController@index')->name('admin/members');
      Route::get('admin/member/award-update/{id}', 'Admin\MemberController@view');
      Route::post('admin/member/award-store/{id}', 'Admin\MemberController@store');
      Route::get('admin/member/award-ubah/{id}', 'Admin\MemberController@ubah');
      Route::put('admin/member/award-update/{id}', 'Admin\MemberController@update');

   	// admin setting
   	Route::get('admin/setting', 'Admin\SettingController@index')->name('admin/setting');
   	Route::put('admin/setting', 'Admin\SettingController@update')->name('admin/setting'); 
});
