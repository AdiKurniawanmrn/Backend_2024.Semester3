<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\PegawaiController;


Route::get('/pegawais', [PegawaiController::class, 'index']);
Route::post('/pegawais', [PegawaiController::class, 'store']);
Route::get('/pegawais/{id}', [PegawaiController::class, 'show']);
Route::put('/pegawais/{id}', [PegawaiController::class, 'update']);
Route::delete('/pegawais/{id}', [PegawaiController::class, 'destroy']);

// Route untuk pencarian pegawai
Route::get('pegawais/search', [PegawaiController::class, 'search']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
