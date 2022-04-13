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
Route::get("/",function(){
    return view('nomor1');
});
// NOMOR 1
Route::get('/roketin_time',function(){
    $earth_seconds = 0;
    if(request('seconds')) $earth_seconds=request('seconds');
    if(request('minutes')) $earth_seconds+=request('minutes')*60;
    if(request('hours')) $earth_seconds+=request('hours')*3600;

    $roketin_hours = str_pad(floor($earth_seconds/10000),2,'0',STR_PAD_LEFT);
    $earth_seconds-=$roketin_hours*10000;
    $roketin_minutes = str_pad(floor($earth_seconds/100),2,'0',STR_PAD_LEFT);
    $earth_seconds-=$roketin_minutes*100;
    $roketin_seconds = str_pad($earth_seconds,2,'0',STR_PAD_LEFT);
    return response()->json("$roketin_hours:$roketin_minutes:$roketin_seconds");
});