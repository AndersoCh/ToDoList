<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('notas', [NotasController::class, 'index']);
    Route::post('nota/store', [NotasController::class, 'store']);

    Route::get('nota/{id}', [NotasController::class, 'show']);
    Route::put('nota/{id}', [NotasController::class, 'update']);
    Route::delete('nota/{id}', [NotasController::class, 'destroy']);

    Route::get('usuarios', [UsuariosController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});