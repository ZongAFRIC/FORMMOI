<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
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


Route::get('/', [PageController::class, 'index']);

Route::get('/formations', [FormationController::class, 'index']);


Route::get('/register',[PageController::class, 'register'])->name('registerEtudiant');
Route::post('/register',[PageController::class, 'register'])->name('registerEtudiant');


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
