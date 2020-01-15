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
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/logout', function (Request $request) {


        return redirect('/');

});

Route::post('login_check', 'LoginController@check_login');


Route::resource('dashboard', 'DashboardController');

Route::resource('customer', 'Customermasetcontroller');
Route::get('getallcustomer', 'Customermasetcontroller@getallcustomer');
Route::post('editcustomer', 'Customermasetcontroller@editcustomer');
Route::post('editdoccustomer', 'Customermasetcontroller@editdoccustomer');
Route::get('deletecustomer/{id}', 'Customermasetcontroller@deletecustomer');


//for agent

Route::resource('agent', 'Agentmastercontroller');
Route::get('getallagent', 'Agentmastercontroller@getallagent');
Route::get('deleteagent/{id}', 'Agentmastercontroller@deleteagent');
Route::post('editagent', 'Agentmastercontroller@editagent');
Route::match(['get','post'], 'uplaodprofieagent', 'Agentmastercontroller@uplaodprofieagent');
Route::match(['get','post'], 'uploadingcustfile', 'Customermasetcontroller@uploadingcustfile');



//for sitemanagement

Route::resource('sitemaster', 'Sitemastercontroller');
Route::get('getallsites', 'Sitemastercontroller@getallsites');
Route::get('deletesite/{id}', 'Sitemastercontroller@deletesite');
Route::post('editplotsdetalis', 'Sitemastercontroller@editplotsdetalis');

//for ploats Allocation
Route::get('getdropcustomer', 'Ploateallocationcontroller@getdropcustomer');
Route::get('getdropsites', 'Ploateallocationcontroller@getdropsites');
Route::get('getdropagent', 'Ploateallocationcontroller@getdropagent');
Route::post('getsiteplots', 'Ploateallocationcontroller@getsiteplots');
Route::post('getploatamtsqftdata', 'Ploateallocationcontroller@getploatamtsqftdata');
Route::post('getpaymenthistory', 'Ploateallocationcontroller@getpaymenthistory');
Route::get('getallploatallocation', 'Ploateallocationcontroller@getallploatallocation');
Route::get('deleteploatalocate/{id}', 'Ploateallocationcontroller@deleteploatalocate');

Route::resource('ploatallocation', 'Ploateallocationcontroller');

Route::resource('agentcommission', 'Agentcommissioncotroller');
Route::get('getdropagentcommission', 'Agentcommissioncotroller@getdropagentcommission');
Route::get('getagentcommssioninfo', 'Agentcommissioncotroller@getagentcommssioninfo');
Route::post('getagentsite', 'Agentcommissioncotroller@getagentsite');
Route::post('getagentsiteploat', 'Agentcommissioncotroller@getagentsiteploat');
Route::post('getagentallcommssion', 'Agentcommissioncotroller@getagentallcommssion');
Route::post('getagenthistory', 'Agentcommissioncotroller@getagenthistory');




//for rolemanagement

Route::resource('rolemanagement', 'Rolemanagementcontroller');
Route::get('get_menu', 'Rolemanagementcontroller@getallmenu');
Route::get('getallrole', 'Rolemanagementcontroller@getallrole');
Route::get('deleterole/{id}', 'Rolemanagementcontroller@deleterole');
Route::post('getuserright', 'Rolemanagementcontroller@getuserright');



Route::resource('employ', 'Employmaster');
Route::get('getallemployee', 'Employmaster@getallemployee');
Route::get('deleteemp/{id}', 'Employmaster@deleteemp');
Route::post('editlogin', 'Employmaster@editlogin');
Route::get('getdroprole', 'Employmaster@getdroprole');


Route::match(['get','post'], 'uploadingfile', 'Customermasetcontroller@uploadingfile');

