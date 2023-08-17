<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/generate-code', [CodeController::class, 'generateUniqueCode'])->name('generate-code');
Route::post('/allocate-code', [CodeController::class, 'allocateCode']);
Route::post('/reset-allocated-code', [CodeController::class, 'resetAllocatedCode'])->name('reset-allocated-code');
