<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Publicacion;

class ComentarioController extends Controller
{
    public function dePublicacion($id) {
        $comentarios = Comentario::where('publicacion_id',$id)->get();
        return response()->json($comentarios, 200);
    }
    
    public function mostrar($id){
        $comentario = Comentario::find($id);
        return response()->json($comentario, 200);
    }
    
    public function crear(Request $request) {
        $comentarios = Comentario::create($request->all());
        return response()->json($comentarios, 201);
    }
        
    public function eliminar($id){
        $comentario = Comentario::findOrFail($id);
        $comentario->delete;
        return response()->json($comentario, 204);
    }
}
