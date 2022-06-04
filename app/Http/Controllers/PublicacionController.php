<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Amistad;
use Illuminate\Support\Facades\Auth;

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
        $publicacion = Publicacion::create([
            'descripcion' => $request->descripcion,
            'imagen'=> $request->imagen,
            'nro_likes'=> $request->nro_likes,
            'nro_comentarios'=> $request->nro_comentarios,
            'isLiked' => false,
            'isFavorite'=> false,
            'estado'=> 'A',
            'user_id'=> Auth::id(),
            'etiquetas'=> $request->etiquetas
        ]);
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

    public function deUsuario($id){
        $publicaciones = Publicacion::where('user_id', $id)->where('estado','1')->get();
        return response()->json($publicaciones, 200);
    }

    public function mias(){
        $publicaciones = Publicacion::where('user_id', Auth::id())->where('estado','1')->get();
        return response()->json($publicaciones, 200);
    }

    public function buscar(Request $request){
        $publicaciones = Publicacion::where('descripcion','ilike','%'. $request->busqueda .'%')->orWhere('etiquetas','ilike','%'. $request->busqueda. '%')->get();
        return response()->json($publicaciones, 200);
    }

    public function feed(){

        //Obtener amigos del usuario
        $usuario = Auth::id();
        $amigos_user_id = Amistad::where('user_id',$usuario)->where('estado','A')->get();
        $amigos_amigo_id = Amistad::where('amigo_id',$usuario)->where('estado','A')->get();
        $amigos = array();    
        foreach($amigos_user_id as $amigo){
            array_push($amigos,$amigo->amigo_id);
        }
        foreach($amigos_amigo_id as $amigo){
            array_push($amigos,$amigo->user_id);
        }
        array_push($amigos,$usuario);

        //Usuario y amigos están cargados en el arreglo de $amigos.
        $publicacionesFeed = collect([]);
        foreach($amigos as $amigo){
            $publicacionesAmigo = Publicacion::where('user_id', $amigo);
            foreach ($publicacionesAmigo as $pubs){
                $publicacionesFeed->prepend($pubs);
            }
        }
        $sorted = $publicacionesFeed->sortBy('created_at');
        return response($sorted, 200);
    }
}