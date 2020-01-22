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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/logout', function (Request $request) {

    $request->session()->flush();
        return redirect('/');

});
Route::get('/', function () {
    return view('loginnew');
});

Route::post('login_check', 'LoginController@check_login');

//for dashboard
Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes();

Route::resource('dashboard', 'DashboardController');
Route::post('getdashboarddata', 'DashboardController@getdashboarddata');
Route::post('getagentinfo', 'DashboardController@getagentinfo');
Route::post('getagentploatsale', 'DashboardController@getagentploatsale');
Route::post('getagentploatsaleinfo', 'DashboardController@getagentploatsaleinfo');


//for Customer

Route::resource('customer', 'Customermasetcontroller');
Route::get('getallcustomer', 'Customermasetcontroller@getallcustomer');
Route::post('editcustomer', 'Customermasetcontroller@editcustomer');
Route::post('editdoccustomer', 'Customermasetcontroller@editdoccustomer');
Route::get('deletecustomer/{id}', 'Customermasetcontroller@deletecustomer');
Route::post('updatecustomerinfo', 'Customermasetcontroller@updatecustomerinfo');
Route::post('getpaymentinfo', 'Customermasetcontroller@getpaymentinfo');

//for agent

Route::resource('agent', 'Agentmastercontroller');
Route::get('getallagent', 'Agentmastercontroller@getallagent');
Route::get('deleteagent/{id}', 'Agentmastercontroller@deleteagent');
Route::post('editagent', 'Agentmastercontroller@editagent');
Route::match(['get','post'], 'uplaodprofieagent', 'Agentmastercontroller@uplaodprofieagent');
Route::match(['get','post'], 'uploadingcustfile', 'Customermasetcontroller@uploadingcustfile');
Route::post('updateagentinfo', 'Agentmastercontroller@updateagentinfo');
Route::post('getagentpayment', 'Agentmastercontroller@getagentpayment');


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
Route::get('deleteagentcommsion/{id}', 'Agentcommissioncotroller@deleteagentcommsion');



//for rolemanagement

Route::resource('rolemanagement', 'Rolemanagementcontroller');
Route::get('get_menu', 'Rolemanagementcontroller@getallmenu');
Route::get('getallrole', 'Rolemanagementcontroller@getallrole');
Route::get('deleterole/{id}', 'Rolemanagementcontroller@deleterole');
Route::post('getuserright', 'Rolemanagementcontroller@getuserright');



Route::resource('employee', 'Employmaster');
Route::get('getallemployee', 'Employmaster@getallemployee');
Route::get('deleteemp/{id}', 'Employmaster@deleteemp');
Route::post('editlogin', 'Employmaster@editlogin');
Route::get('getdroprole', 'Employmaster@getdroprole');


Route::match(['get','post'], 'uploadingfile', 'Customermasetcontroller@uploadingfile');

//for report
Route::resource('agentreport', 'Acstatementcontroller');
Route::post('getagentrepdata', 'Acstatementcontroller@getagentrepdata');

//for remina ploats
Route::resource('remainplots', 'Remainploatscontroller');
Route::post('getremainploatsdata', 'Remainploatscontroller@getremainploatsdata');

//for sold report
Route::resource('soldplots', 'Soldplotcontroller');
Route::post('getsoldloatsdata', 'Soldplotcontroller@getsoldloatsdata');


});

