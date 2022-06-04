<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;
use App\Models\User;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    public function misFavoritos() {

        $usuario = User::findOrFail(Auth::id());
        
        $publicacionesFavoritas = Favorito::where('user_id',$usuario->id)->get();

        $publicaciones = array();

        foreach($publicacionesFavoritas as $publicacionFav){
            array_push($publicaciones, Publicacion::where('id', $publicacionFav->publicacion_id)->get());
        }

        return response()->json($publicaciones, 200);
    }

    public function leFavoritoPublicacion($id){
        $favorito = Favorito::where('publicacion_id',$id)->first();
        if($favorito)
            return response()->json(true, 200);
        else
            return response()->json(false, 200);
    }
    
    public function mostrar($id){
        $favorito = Favorito::find($id);
        return response()->json($favorito, 200);
    }
    
    public function crear(Request $request) {
        $favorito = Favorito::create($request->all());
        return response()->json($favorito, 201);
    }
    
    public function eliminar($id){
        $favorito = Favorito::findOrFail($id);
        $favorito->delete;
        return response()->json($favorito, 204);
    }
}
