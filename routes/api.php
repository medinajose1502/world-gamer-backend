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
    
    //Rutas de usuarios
    Route::get('usuarios', 'App\Http\Controllers\UserController@todos');
    Route::get('usuarios/{id}', 'App\Http\Controllers\UserController@mostrar');
    Route::post('usuarios', 'App\Http\Controllers\UserController@crear');
    Route::put('usuarios/{id}', 'App\Http\Controllers\UserController@actualizar');
    Route::delete('usuarios/{id}', 'App\Http\Controllers\UserController@eliminar');
    
    //Rutas para subir imágenes
    Route::post('imagen/perfil', 'App\Http\Controllers\ImagenController@perfil');
    Route::post('imagen/publicacion', 'App\Http\Controllers\ImagenController@publicacion');
    
    //Rutas de amigos
    Route::post('amigos', 'App\Http\Controllers\AmistadController@agregarAmigo');
    Route::get('amigos', 'App\Http\Controllers\AmistadController@consultarAmigos');
    Route::get('amigos/pendientes', 'App\Http\Controllers\AmistadController@consultarAmigosPendientes');
    Route::post('amigos/aceptar/{id}', 'App\Http\Controllers\AmistadController@aceptarAmigo');
    Route::delete('amigos/{id}', 'App\Http\Controllers\AmistadController@eliminarAmigo');
    
    //Rutas de favoritos
    Route::get('favoritos', 'App\Http\Controllers\FavoritoController@misFavoritos');
    Route::get('favoritos/{id}', 'App\Http\Controllers\MeGustaController@mostrar');
    Route::post('favoritos', 'App\Http\Controllers\FavoritoController@crear');
    Route::delete('favoritos/{id}', 'App\Http\Controllers\FavoritoController@eliminar');

    //Rutas de megusta
    Route::get('megusta/publicacion/{id}', 'App\Http\Controllers\MeGustaController@dePublicacion');
    Route::get('megusta', 'App\Http\Controllers\MeGustaController@misMeGusta');
    Route::get('megusta/{id}', 'App\Http\Controllers\MeGustaController@mostrar');
    Route::post('megusta', 'App\Http\Controllers\MeGustaController@crear');
    Route::delete('megusta/{id}', 'App\Http\Controllers\MeGustaController@eliminar');

    //Rutas de comentarios
    Route::get('comentarios/publicacion/{id}', 'App\Http\Controllers\ComentarioController@dePublicacion');
    Route::get('comentarios/{id}', 'App\Http\Controllers\ComentarioController@mostrar');
    Route::post('comentarios', 'App\Http\Controllers\ComentarioController@crear');
    Route::delete('comentarios/{id}', 'App\Http\Controllers\ComentarioController@eliminar');

    //Rutas de notificaciones
    Route::get('notificaciones', 'App\Http\Controllers\NotificacionController@deUsuario');
    Route::get('notificaciones/{id}', 'App\Http\Controllers\NotificacionController@mostrar');
    Route::post('notificaciones', 'App\Http\Controllers\NotificacionController@crear');
    Route::delete('notificaciones/{id}', 'App\Http\Controllers\NotificacionController@eliminar');
});

