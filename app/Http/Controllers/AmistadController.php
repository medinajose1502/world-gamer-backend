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
        return $amistad = Amistad::create($request->all());
    }

    public function consultarAmigos(){
        $usuario = User::findOrFail(Auth::id());

        $amigos_user_id = Amistad::where('user_id',$usuario->id)->get();
        
        $amigos_amigo_id = Amistad::where('amigo_id',$usuario->id)->get();
        
        $amigos = array();
        
        foreach($amigos_user_id as $amigo){
            array_push($amigos,$amigo->amigo_id);
        }
        
        foreach($amigos_amigo_id as $amigo){
            array_push($amigos,$amigo->user_id);
        }
        
        return response()->json(['amigos' => $amigos],200);
    }
    
    public function eliminarAmigo($id){
        $usuario = User::findOrFail(Auth::id());
        
        $amistad = Amistad::where('user_id',$usuario->id)
        ->where('amigo_id',$id)->get();
        
        if($amistad)
            $amitad->delete();
        else
            {
                $amistad = Amistad::where('amigo_id',$usuario->id)
                ->where('user_id',$id)->get();
                $amistad->delete();
            }
            
    }
    
    
    
}
