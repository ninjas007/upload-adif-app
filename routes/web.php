<?php

use Illuminate\Support\Facades\Route;
use App\UserAdif;

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

Route::get('/api/newmember', 'API\MemberController@create');
Route::get('/api/members', 'API\MemberController@getMembers');
Route::get('/api/member/{id}', 'API\MemberController@getMemberById');
Route::get('/api/member/{start}/{limit}', 'API\MemberController@getMemberByOffset');
Route::get('/api/deletemember', 'API\MemberController@deleteMember');
Route::get('/api/updatemember', 'API\MemberController@update');


Route::get('/', 'WelcomeController@index');
Route::get('/list-award', 'WelcomeController@index');
Route::get('/list-member', 'WelcomeController@members');
Route::get('/detailMember', 'WelcomeController@jsonDetailMember');
Route::post('/jsonMembers', 'WelcomeController@jsonMembers');
Route::post('/admin/jsonAdminMembers', 'Admin\MemberController@jsonAdminMembers');
Route::post('/admin/jsonAwardsMember', 'Admin\AwardController@jsonAwardMembers');
Route::post('/jsonAwards', 'AwardController@jsonAwards');

Route::get('/bersihkan', function () {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";
});

Auth::routes();
Auth::routes([
   'register' => false
]);

Route::get('register', function(){
   return redirect('/');
});

Route::get('send-mail', 'UploadController@mail');

Route::get('cronjob', 'CronJobController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['can:isMember', 'auth']], function() {
	Route::get('/awards', 'AwardController@index')->name('awards');
	Route::get('/profile', 'ProfileController@index');
	Route::put('/profile', 'ProfileController@update')->name('profile');
	Route::get('/upload', 'UploadController@index')->name('upload');
   Route::post('/upload-file', 'UploadController@store')->name('upload-file');
   Route::get('/checkAwardToClaim', 'AwardController@checkAwardToClaim');
});

Route::group(['middleware' => ['can:isAdmin', 'auth']], function () {
    
	Route::get('admin', 'Admin\AdminController@index')->name('admin');
   Route::get('admin/listAdmin', 'Admin\AdminController@listAdmin')->name('admin/listAdmin');
   Route::get('admin/admin-tambah', 'Admin\AdminController@create')->name('admin/admin-tambah');
   Route::post('admin/admin-tambah', 'Admin\AdminController@store')->name('admin/admin-tambah');
   Route::get('/admin/admin-edit/{id}', 'Admin\AdminController@edit');
   Route::post('/admin/admin-update', 'Admin\AdminController@update');
   Route::get('/admin/admin-hapus/{id}', 'Admin\AdminController@destroy');

	// admin award
	Route::get('admin/awards', 'Admin\AwardController@index')->name('admin/awards');
	Route::get('admin/award/tambah', 'Admin\AwardController@create')->name('admin/award-tambah');
	Route::post('admin/award/tambah', 'Admin\AwardController@store')->name('admin/award-tambah');
	Route::get('admin/award/ubah/{uuid}', 'Admin\AwardController@edit');
	Route::put('admin/award/ubah/{uuid}', 'Admin\AwardController@update');
	Route::get('admin/award/hapus/{id}', 'Admin\AwardController@destroy');

	// admin member
	Route::get('admin/members', 'Admin\MemberController@index')->name('admin/members');
   Route::get('admin/member/tambah', 'Admin\MemberController@create')->name('admin/member-tambah');
   Route::post('admin/member/tambah', 'Admin\MemberController@tambah')->name('admin/member-tambah');
   Route::get('admin/member/detail', 'Admin\MemberController@show');
   Route::get('admin/member/edit/{id}', 'Admin\MemberController@edit');
   Route::put('admin/member/update', 'Admin\MemberController@updateUser')->name('admin/member/update');
   Route::get('admin/member/hapus/{id}', 'Admin\MemberController@destroy');
   Route::get('admin/member/award-update/{id}', 'Admin\MemberController@view');
   Route::post('admin/member/award-store/{id}', 'Admin\MemberController@store');
   Route::get('admin/member/award-ubah/{id}', 'Admin\MemberController@ubah');
   Route::put('admin/member/award-update/{id}', 'Admin\MemberController@update');

   // admin banner
   Route::get('admin/banners', 'Admin\BannerController@index')->name('admin/banners');
   Route::get('/admin/banner/edit/{id}', 'Admin\BannerController@edit');
   Route::put('/admin/banners/update/{id}', 'Admin\BannerController@update')->name('admin/banners/update');

	// admin setting
	Route::get('admin/setting', 'Admin\SettingController@index')->name('admin/setting');
	Route::put('admin/setting', 'Admin\SettingController@update')->name('admin/setting');

   // admin rules
   Route::get('admin/rules', 'Admin\RulesController@index')->name('admin/rules');
   Route::get('/admin/rules/tambah', 'Admin\RulesController@create');
   Route::post('/admin/rules/store', 'Admin\RulesController@store');
   Route::get('/admin/rules/hapus/{id}', 'Admin\RulesController@destroy');
});