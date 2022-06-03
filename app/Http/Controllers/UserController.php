<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function todos() {
        $users = User::all();
        return response()->json($useres, 200);
    }
    
    public function mostrar($id){
        $user = User::find($id);
        return response()->json($user, 200);
    }
    
    public function crear(Request $request) {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }
    
    public function actualizar(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }
    
    public function eliminar($id){
        $user = User::findOrFail($id);
        $user->delete;
        return response()->json($user, 204);
    }
}
