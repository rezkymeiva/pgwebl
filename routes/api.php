<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\UsulanPublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'points'])->name('api.points');
Route::get('/point/{id}', [ApiController::class, 'point'])->name('api.point');
Route::get('/polylines', [ApiController::class, 'polylines'])->name('api.polylines');
Route::get('/polyline/{id}', [ApiController::class, 'polyline'])->name('api.polyline');
Route::get('/polygon', [ApiController::class, 'polygon'])->name('api.polygon');
Route::get('/polygons/{id}', [ApiController::class, 'polygons'])->name('api.polygons');

Route::post('/usulan', [UsulanPublicController::class, 'store']); // Tambah usulan publik
Route::get('/usulan', [UsulanPublicController::class, 'index']); // Ambil semua usulan
Route::put('/usulan/{id}/status', [UsulanPublicController::class, 'updateStatus']); // Ubah status usulan

