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
    return view('welcome');
});

Auth::routes();

//Users
Route::get('/getUsers','HomeController@getUsers');
Route::post('/addUser','HomeController@addUser');
Route::put('/updateUser/{id}','HomeController@updateUser');
Route::delete('/deleteUser/{id}','HomeController@deleteUser');

Route::get('/home', 'HomeController@index')->name('home');

//Schedule
Route::post('/addSchedule','ScheduleController@store');

Route::post('/getSchedule','ScheduleController@index');

Route::get('/getAllSchedule','ScheduleController@getAllSchedules');
Route::put('/updateSchedule/{id}','ScheduleController@updateSchedule');

//Get all scores in every user
Route::get('/getAllScores','QuestionController@getAllScores');

// Get schedules by year level
Route::get('/getSchedulesYear/{date?}','ScheduleController@getSchedulesByYearLevel');

//Get schedules by course
Route::get('/getSchedulesCourse/{date?}','ScheduleController@getSchedulesByCourse');

//Get schedules by type
Route::get('/getSchedulesType/{date?}','ScheduleController@getSchedulesByType');

//Get schedules by gender
Route::get('/getSchedulesGender/{date?}','ScheduleController@getSchedulesByGender');

//count total pending
Route::get('/countPending','HomeController@countPending');

//count total pending users
Route::get('/countPendingUsers','HomeController@countPendingUsers');

//count total  users
Route::get('/countUsers','HomeController@countTotalUsers');

Route::get('{path}','HomeController@index')->where( 'path', '([A-z]+)?' );