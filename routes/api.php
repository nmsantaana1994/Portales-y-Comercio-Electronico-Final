<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Recuerden: todas las rutas que definamos acá van a llevar el prefijo "api/" automáticamente.
Route::get("bicicletas", [\App\Http\Controllers\API\BicicletasAdminController::class, "index"])
    ->middleware(["auth"]);
Route::get("bicicletas/{id}", [\App\Http\Controllers\API\BicicletasAdminController::class, "view"])
    ->middleware(["auth"]);
Route::post("bicicletas", [\App\Http\Controllers\API\BicicletasAdminController::class, "create"])
    ->middleware(["auth"]);