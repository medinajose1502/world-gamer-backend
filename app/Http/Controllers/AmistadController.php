<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Amistad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AmistadController extends Controller
{
    
    public function agregarAmigo(Request $request){
        return $amistad = Amistad::create([
            'estado' => 'P',
            'amigo_id' => $request->amigo_id,
            'user_id' => Auth::id()
        ]);
    }

    public function consultarAmigos(){
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

        $resultado = array();

        foreach($amigos as $amigo){
            array_push($resultado, User::findOrFail($amigo));
        }
        
        return response()->json(['amigos' => $resultado],200);
    }

    public function consultarAmigosPendientes(){
        $usuario = Auth::id();

        $amigos_user_id = Amistad::where('user_id',$usuario)->where('estado','P')->get();
        
        $amigos_amigo_id = Amistad::where('amigo_id',$usuario)->where('estado','P')->get();
        
        $amigos = array();
        
        foreach($amigos_user_id as $amigo){
            array_push($amigos,$amigo->amigo_id);
        }
        
        foreach($amigos_amigo_id as $amigo){
            array_push($amigos,$amigo->user_id);
        }

        $resultado = array();

        foreach($amigos as $amigo){
            array_push($resultado, User::findOrFail($amigo));
        }
        
        return response()->json(['amigos' => $resultado],200);
    }

    public function aceptarAmigo($id){
        $usuario = Auth::id();

        $amigo = Amistad::where('user_id', $id)->where('amigo_id',$usuario)->first();
        $amigo->estado = 'A';
        $amigo->save();
        return response($amigo, 200);
    }
    
    public function eliminarAmigo($id){
        $usuario = Auth::id();
        
        $amistad = Amistad::where('user_id',$usuario)
        ->where('amigo_id',$id)->first();
        
        if($amistad){
            $amitad->delete();
            return response($amistad,200);
        }
        else
            {
                $amistad = Amistad::where('amigo_id',$usuario)
                ->where('user_id',$id)->first();
                $amistad->delete();
                return response($amistad,200);
            } 
    }
}
