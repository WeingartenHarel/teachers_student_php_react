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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/user','UserController');



// All REST CRUD ROUTES
Route::post('/storeuser','UserController@storeuser');
Route::get('/getusers','UserController@getuser');
Route::post('/updateuser','UserController@updateuser');
Route::get('/edituser','UserController@edituser');
Route::post('/deleteuser','UserController@deleteuser');
// END ALL REST CRUD ROUTES



// Student Routes
Route::get('/student/dashboard',function(){
    return view('student.home');
})->name('student.dashboard')->middleware('student');

Route::get('/student/profile',function(){
    return view('student.profile');
})->name('student.profile')->middleware('student');


Route::get('/student/password',function(){
    return view('student.password');
})->name('student.password')->middleware('student');


Route::post('/student/profile/update','UserController@updateprofile')->name('student.profile.update')->middleware('student');

Route::post('/student/password/update','UserController@updatepassword')->name('student.password.update')->middleware('student');
// End student routes




// Start Admin routes
Route::get('/admin/dashboard',function(){
    return view('admin.home');
})->name('admin.dashboard')->middleware('admin');


Route::get('/admin/profile',function(){
    return view('admin.profile');
})->name('admin.profile')->middleware('admin');
Route::get('/admin/password',function(){
    return view('admin.password');
})->name('admin.password')->middleware('admin');
Route::post('/admin/profile/update','UserController@updateprofile')->name('admin.profile.update')->middleware('admin');
Route::post('/admin/password/update','UserController@updatepassword')->name('admin.password.update')->middleware('admin');



//period routes

Route::get('/admin/your/period/', 'PeriodController@showPeriodPage')->name('admin.period')->middleware('admin');

Route::get('/all/periods/', 'PeriodController@allPeriods')->name('all.periods');


Route::get('/student/your/periods/', 'PeriodController@studentPeriodOwn')->name('student.own.periods')->middleware('student');



Route::get('/period/details/{period}', 'PeriodController@showPeriodDetails')->name('period.drtails');



Route::get('/student/show', 'PeriodController@showStudent')->name('show.student');


Route::get('/teacher/show', 'PeriodController@showTeacher')->name('show.teacher');



Route::get('/teacher/student/details/{user}', 'PeriodController@showTeacherAndStudentDetails')->name('show.teacher.student.details');



Route::post('/admin/period/create', 'PeriodController@store')->name('create.period')->middleware('admin');


Route::put('/admin/period/update/{period}', 'PeriodController@updatePeriod')->name('update.period')->middleware('admin');

//joinInPeriodsForBoth

Route::post('/admin/period/join/{period}', 'PeriodController@joinInPeriodsForBoth')->name('join.period');


Route::delete('/admin/period/delete/{period}', 'PeriodController@deletePeriod')->name('delete.period')->middleware('admin');


Route::delete('/admin/period/remove/teacher/{period}', 'PeriodController@removeTeacherFromMyPeriod')->name('remove.teacher.period')->middleware('admin');


Route::delete('/admin/period/remove/student/{period}', 'PeriodController@removeStudentFromMyPeriod')->name('remove.student.period')->middleware('admin');



Route::get('/home','HomeController@index')->name('home');
// End Admin routes