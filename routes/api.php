<?php

use App\Http\Controllers\MovieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// NOMOR 2
Route::prefix('movie')->group(function () {
    Route::post('/',[MovieController::class,'store']);
    Route::patch('/',[MovieController::class,'update']);
    Route::get('/list/{page?}',[MovieController::class,'list']);
});

// NOMOR 1
Route::get('/roketin_time',function(){
    $earth_time = request('et');
    $earth_time_array = explode(':',$earth_time);
    $earth_seconds = 0;
    if(isset($earth_time_array[2])) $earth_seconds=$earth_time_array[2];
    if(isset($earth_time_array[1])) $earth_seconds+=$earth_time_array[1]*60;
    $earth_seconds+=$earth_time_array[0]*3600;

    $roketin_hours = floor($earth_seconds/10000);
    $earth_seconds-=$roketin_hours*10000;
    $roketin_minutes = floor($earth_seconds/100);
    $earth_seconds-=$roketin_minutes*100;
    $roketin_seconds = $earth_seconds;
    return response()->json("$roketin_hours:$roketin_minutes:$roketin_seconds");
});