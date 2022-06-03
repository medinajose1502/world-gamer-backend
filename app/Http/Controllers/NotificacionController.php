<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class NotificacionController extends Controller
{
    public function deUsuario() {
        $notificaciones = Notificacion::where('user_id', Auth::id())-get();
        return response()->json($notificaciones, 200);
    }
    
    public function mostrar($id){
        $notificacion = Notificacion::find($id);
        return response()->json($notificacion, 200);
    }
    
    public function crear(Request $request) {
        $notificacion = Notificacion::create($request->all());
        return response()->json($notificacion, 201);
    }
        
    public function eliminar($id){
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete;
        return response()->json($notificacion, 204);
    }
}
