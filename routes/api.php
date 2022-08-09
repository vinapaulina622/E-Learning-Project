<?php

use App\Http\Controllers\API\AbsenController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\KontrakController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\MatakuliahController;
use App\Http\Controllers\API\SemesterController;
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

Route::resource('/mahasiswa', MahasiswaController::class);
Route::resource('/matakuliah', MatakuliahController::class);
Route::resource('/absen', AbsenController::class);
Route::resource('/semester', SemesterController::class);
Route::resource('/kontrak', KontrakController::class);
Route::resource('/jadwal', JadwalController::class);
