<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;

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

// Register & Login tetap di luar middleware
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes yang butuh autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Logout membutuhkan autentikasi

        // Routes Buku dengan Role-Based Access Control (RBAC)
    Route::get('/buku', [BukuController::class, 'index']);
    Route::post('/buku', [BukuController::class, 'store'])->middleware('role:admin,editor');
    Route::put('/buku/{buku}', [BukuController::class, 'update'])->middleware('role:admin,editor');
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->middleware('role:admin');
});
    