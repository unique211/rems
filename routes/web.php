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
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('login_check', 'LoginController@check_login');
Route::resource('customer', 'Customermasetcontroller');
Route::resource('agent', 'Agentmastercontroller');
Route::resource('sitemaster', 'Sitemastercontroller');
Route::resource('ploatallocation', 'Ploateallocationcontroller');
Route::resource('agentcommission', 'Agentcommissioncotroller');

Route::match(['get','post'], 'uploadingfile', 'Customermasetcontroller@uploadingfile');

