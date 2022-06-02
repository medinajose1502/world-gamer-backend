<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function todas() {
        $publicaciones = Publicacion::all();
        return response()->json($publicaciones, 200);
    }
    
    public function mostrar($id){
        $publicacion = Publicacion::find($id);
        return response()->json($publicacion, 200);
    }
    
    public function crear(Request $request) {
        $publicacion = Publicacion::create($request->all());
        return response()->json($publicacion, 201);
    }
    
    public function actualizar(Request $request, $id){
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->update($request->all());
        return response()->json($publicacion, 200);
    }
    
    public function eliminar($id){
        $publicacion = Publicacion::findOrFail($id);
        $publicacion->delete;
        return response()->json($publicacion, 204);
    }
}
