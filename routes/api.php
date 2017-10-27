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

/*
=============== USERS ===============
*/

/** User: post data to retrieve tokens */
Route::post('/user', 'UsersController@Register');

/** User: get current user */
Route::middleware('auth:api')->post('/me', 'UsersController@Me');

/*
=============== EVENTS ===============
*/

/** Event: get all events from user */
Route::middleware('auth:api')->get('/events', 'EventsController@GetAll');

/** Event: get one event from user */
Route::middleware('auth:api')->get('/events/{id}', 'EventsController@GetOne');

/** Event: create an event for user */
Route::middleware('auth:api')->post('/events', 'EventsController@Create');

/** Event: update an event from user */
Route::middleware('auth:api')->post('/events/{id}', 'EventsController@Update');

/*
=============== TEXTS ===============
*/

/** Text: get all texts for event */
Route::get('/texts/{event_id}', 'TextsController@GetAll');

/** Text: create a text for user */
Route::middleware('auth:api')->post('/texts/{event_id}', 'TextsController@Create');





