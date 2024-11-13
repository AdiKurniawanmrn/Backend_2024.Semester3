<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pegawai', [PegawaiController::class,'index']);
Route::post('/pegawai', [PegawaiController::class,'store']);
