<?php
use Illuminate\Http\Request;
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
    return view('loginnew');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/logout', function (Request $request) {


        return redirect('/');

});

Route::post('login_check', 'LoginController@check_login');

Route::resource('customer', 'Customermasetcontroller');
Route::get('getallcustomer', 'Customermasetcontroller@getallcustomer');
Route::post('editcustomer', 'Customermasetcontroller@editcustomer');
Route::post('editdoccustomer', 'Customermasetcontroller@editdoccustomer');
Route::get('deletecustomer/{id}', 'Customermasetcontroller@deletecustomer');

Route::resource('agent', 'Agentmastercontroller');
Route::resource('sitemaster', 'Sitemastercontroller');
Route::resource('ploatallocation', 'Ploateallocationcontroller');
Route::resource('agentcommission', 'Agentcommissioncotroller');
Route::resource('rolemanagement', 'Rolemanagementcontroller');

Route::resource('employ', 'Employmaster');

Route::match(['get','post'], 'uploadingfile', 'Customermasetcontroller@uploadingfile');

