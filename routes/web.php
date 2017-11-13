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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/admin_example', function () {
// 	return view('admin_template');
// });


 // admin access
Route::prefix('manage')->middleware('role:superadministrator|administrator|')->group(function () {
	Route::resource('/users', 'UserController');
	Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
	Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
	Route::resource('/referrals', 'ReferralController', ['except' => 'destroy']);
});
  // normal access
Route::prefix('manage')->middleware('role:superadministrator|administrator|member|user')->group(function () {
	Route::get('/', 'ManageController@index');
 // Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
  Route::resource('/myreferrals', 'myReferralController');
  Route::resource('/myprofile', 'myProfileController',  ['except' => ['create', 'store', 'show', 'destroy' ]]);
});

// reffered user to accept referral
Route::get('/accept/{id}', 'myReferralController@accept')->name('accept');

// reffered user to decline referral
Route::get('/decline/{id}', 'myReferralController@decline')->name('decline');


// Export data to Excel 
Route::get('referrals/excel', 
[
  'as' => 'referrals.excel',
  'uses' => 'ReferralController@excel'
]);

// Export data to Excel 
Route::get('myreferrals/excel', 
[
  'as' => 'myreferrals.excel',
  'uses' => 'myReferralController@excel'
]);
// Export data to CSV 
Route::get('myreferrals/csv', 
[
  'as' => 'myreferrals.csv',
  'uses' => 'myReferralController@csv'
]);
// Export data to CSV 
Route::get('referrals/csv', 
[
  'as' => 'referrals.csv',
  'uses' => 'ReferralController@csv'
]);