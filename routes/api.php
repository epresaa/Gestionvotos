<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Ruta GET
Route::get('getVotes', 'App\Http\Controllers\VotingController@showVotes')->name('getVotes');
// Ruta POST
Route::post('vote', 'App\Http\Controllers\VotingController@vote')->name('vote');