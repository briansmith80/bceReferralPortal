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

// Route::get('/', function () {
//     return redirect('login');
// });
// Route::get('/', function () {
//     return redirect('/manage/dashboard');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('/');
// Route::get('/home', function () {
//     return redirect('/manage/dashboard');
// });

// All access to my profile
Route::resource('/myprofile', 'myProfileController',  ['except' => ['create', 'store', 'show', 'destroy' ]]);
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

 // admin access
Route::prefix('manage')->middleware('role:superadministrator|administrator|')->group(function () {
	Route::resource('/users', 'UserController');
	Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
	Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
	Route::resource('/referrals', 'ReferralController', ['except' => 'destroy']);
  Route::resource('/companies', 'CompanyController');
 
});
  // friend / agent  access
Route::prefix('manage')->middleware('role:superadministrator|administrator|member|user|friend|agent')->group(function () {
  Route::resource('/myreferrals', 'myReferralController');
  
});

  // supplier  access
Route::prefix('manage')->middleware('role:superadministrator|administrator|member|user|supplier')->group(function () {
  Route::resource('/mycompany', 'myCompanyController');

});

// reffered user to accept referral
//Route::get('/changerole/{id}', 'UserController@changerole')->name('changerole');

// referred user to accept referral
Route::get('/accept/{id}', 'myReferralController@accept')->name('accept');
// referred user to decline referral
Route::get('/decline/{id}', 'myReferralController@decline')->name('decline');



 // Export data to Excel 
  Route::get('referrals/excel', ['as' => 'referrals.excel', 'uses' => 'ReferralController@excel']);
  // Export data to CSV 
  Route::get('referrals/csv', ['as' => 'referrals.csv', 'uses' => 'ReferralController@csv']);
  // Export data to Excel 
  Route::get('companies/excel', ['as' => 'companies.excel', 'uses' => 'CompanyController@excel']);
  // Export data to CSV 
  Route::get('companies/csv', ['as' => 'companies.csv', 'uses' => 'CompanyController@csv']);




  // Export data to Excel 
  Route::get('myreferrals/excel', ['as' => 'myreferrals.excel', 'uses' => 'myReferralController@excel']);
  // Export data to CSV 
  Route::get('myreferrals/csv', ['as' => 'myreferrals.csv', 'uses' => 'myReferralController@csv']);


    // Export data to Excel 
  Route::get('mycompany/excel', ['as' => 'mycompany.excel', 'uses' => 'myCompanyController@excel']);
  // Export data to CSV 
  Route::get('mycompany/csv', ['as' => 'mycompany.csv', 'uses' => 'myCompanyController@csv']);