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