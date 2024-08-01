<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user/profile', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('kategori', [Kategoricontroller::class, 'index']);
// Route::post('kategori', [Kategoricontroller::class, 'store']);
// Route::get('kategori/{id}', [Kategoricontroller::class, 'show']);
// Route::put('kategori/{id}', [Kategoricontroller::class, 'update']);
// Route::delete('kategori/{id}', [Kategoricontroller::class, 'destroy']);


// Route::resource('kategori', KategoriController::class)->except(['edit', 'create']);
// Route::resource('tag', TagController::class)->except(['edit', 'create']);
// Route::resource('user', UserController::class)->except(['edit', 'create']);
// Route::resource('berita', BeritaController::class)->except(['edit', 'create']);

// auth route

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('kategori', KategoriController::class)->except(['edit', 'create']);
    Route::resource('tag', TagController::class)->except(['edit', 'create']);
    Route::resource('user', UserController::class)->except(['edit', 'create']);
    Route::resource('berita', BeritaController::class)->except(['edit', 'create']);
});