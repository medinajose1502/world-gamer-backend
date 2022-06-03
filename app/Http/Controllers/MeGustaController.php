<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeGusta;
use App\Models\User;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class MeGustaController extends Controller
{
    public function misMeGusta() {

        $usuario = User::findOrFail(Auth::id());
        
        $publicacionesQueGustan = MeGusta::where('user_id',$usuario->id)->get();

        $publicaciones = array();

        foreach($publicacionesQueGustan as $publicacionMG){
            array_push($publicaciones, Publicacion::where('id', $publicacionMG->publicacion_id)->get());
        }

        return response()->json($publicaciones, 200);
    }

    public function dePublicacion($id){
        $megusta = MeGusta::where('publicacion_id',$id)->get();
        return response()->json($megusta, 200);
    }
        
    public function crear(Request $request) {
        $meGusta = MeGusta::create($request->all());
        return response()->json($meGusta, 201);
    }

    public function mostrar($id){
        $meGusta = MeGusta::find($id);
        return response()->json($meGusta, 200);
    }
    
    public function eliminar($id){
        $meGusta = MeGusta::findOrFail($id);
        $meGusta->delete;
        return response()->json($meGusta, 204);
    }
}
