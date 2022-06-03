<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Rutas publicas
Route::post('registro', 'App\Http\Controllers\AuthController@registro');
Route::post('iniciarSesion', [AuthController::class, 'iniciarSesion']);
Route::post('cerrarSesion', [AuthController::class, 'cerrarSesion']);

// Rutas protegidas
Route::group(['middleware' => ['auth:sanctum']], function () {

    //Rutas de publicaciones
    Route::get('publicaciones', 'App\Http\Controllers\PublicacionController@todas');
    Route::get('publicaciones/{id}', 'App\Http\Controllers\PublicacionController@mostrar');
    Route::post('publicaciones', 'App\Http\Controllers\PublicacionController@crear');
    Route::put('publicaciones/{id}', 'App\Http\Controllers\PublicacionController@actualizar');
    Route::delete('publicaciones/{id}', 'App\Http\Controllers\PublicacionController@eliminar');

    //Rutas para subir imágenes
    Route::post('imagen/perfil', 'App\Http\Controllers\ImagenController@perfil');
    Route::post('imagen/publicacion', 'App\Http\Controllers\ImagenController@publicacion');
});

