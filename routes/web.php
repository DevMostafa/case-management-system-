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
use App\Models\Victim;
use App\Models\District;
use App\Models\Incident;
use App\User;

Route::get('/check', function () {
    $users = Victim::with('district','incident')
        	//->select(\DB::raw('count(*) as total'))
            //->withCount('district')
    	    ->groupBy('district_id','incident_type_id')

    	    ->get();
//return($users);
  		foreach($users as $user){
  		  	echo 'total' .$user->district->name. 'case in district'.'&nbsp;'.'dd'.'is'. '&nbsp;'.$user->total
    	.'</br>';
  		  }
  		//  dd($users);
});


Route::get('/total', function () {
    $users = \DB::table('victims')
    				->join('districts','victims.district_id','=','districts.id')
    				->join('incidents','victims.incident_type_id','=','incidents.id')
                     ->select('districts.name','incidents.incident_type',\DB::raw('count(*) as total'))
                     ->groupBy('district_id','incident_type_id')
                     ->orderBy('district_id','ASC')
                     //->having('total','>',1)
                     ->get();
                   //  dd($users);
    foreach($users as $user){
    	echo 'total' .ucfirst($user->incident_type). 'case in district'.'&nbsp;'.$user->name.'is'. '&nbsp;'.$user->total
    	.'</br>';
    }
});





Route::get('/', function () {
    return redirect()->to('/cases');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['role:admin'])->group(function () {
  //  Route::get('/admin/profile', function () {
        // Uses first & second Middleware
    

Route::resource('cases','CaseRegisterController');

Route::get('cases/{id}/supportingFiles','CaseRegisterController@caseFile')->name('supporting-files');
Route::post('cases/{id}/supportingFiles','CaseRegisterController@caseFileStore')->name('case.file.store');


Route::post('cases/service/create','ServiceController@store')->name('service.store');

Route::post('cases/service/{id}','ServiceController@update')->name('service.update');

Route::post('assign/case/{id}','FollowUpController@store')->name('assign.store');
Route::post('followup/case/{id}','FollowUpController@update')->name('followUp.update');

//search
Route::get('cases','CaseRegisterController@index');

Route::get('items/export/{type}', 'CaseRegisterController@export')->name('download');

Route::get('/cases/search/{view_type}', 'CaseRegisterController@report');



});
    //});
 Route::middleware(['role:lawyer'])->group(function () {
 	Route::get('lawyer',function(){
 		return"ok";
 	});
});



//  Route::group(['namespace' => 'student', 'prefix' => 'student', 'middleware' => 'role', 'role' => "student"], function () {
//     Route::get('student', function(){
//     	return"student";
//     });
// });