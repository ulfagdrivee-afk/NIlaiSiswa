<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\AuthController;



 Route::post('/auth/register', [AuthController::class , 'register']);
 Route::post('/auth/login', [AuthController::class , 'login']);
Route::middleware('auth:sanctum')->group(function () {
 Route::post('/auth/logout', [AuthController::class , 'logout']);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/nilai', [NilaiController::class , 'store']);
    Route::get('/nilai', [NilaiController::class , 'index']);
    Route::put('/nilai/{id}', [NilaiController::class , 'update']);
    Route::delete('/nilai/{id}', [NilaiController::class , 'destroy']);

});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/siswa', [SiswaController::class , 'store']);
    Route::get('/siswa', [SiswaController::class , 'index']);
    Route::put('/siswa/{id}', [SiswaController::class , 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class , 'destroy']);

    Route::post('/mapel', [MapelController::class , 'store']);
    Route::get('/mapel', [MapelController::class , 'index']);
    Route::put('/mapel/{id}', [MapelController::class , 'update']);
    Route::delete('/mapel/{id}', [MapelController::class , 'destroy']);

});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
