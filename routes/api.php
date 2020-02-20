<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([ 'prefix' => 'auth'], function (){ 
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'API\AuthController@login');
        Route::post('signup', 'API\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('getuser', 'API\AuthController@getUser');

        //Questions
        Route::post('getQuestions','API\QuestionsController@viewQuestionsWithChoices');
        //Submit Answer
        Route::post('submit','API\QuestionsController@submitAnswer');
        //get Schedules
        Route::get('/getSchedules','API\QuestionsController@getSchedules');
        //get Personal score with Details
        Route::get('/getPersonalScore','API\QuestionsController@personalScore');
        
        //get Personal score with details
        // Route::get('/getPersonalScoreWithDetails','API\QuestionsController@personalScoreWithDetails');

    });
}); 