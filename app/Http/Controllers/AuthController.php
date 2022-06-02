<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registrar(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:user,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('world-gamer-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function cerrarSesion(Request $request) {
        auth()->user()->tokens()->delete();

        $response = [
            'mensaje' => 'Ha cerrado sesión exitosamente.'
        ];
        return response($response, 200);
    }

    public function iniciarSesion(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            $response = [
                'mensaje' => 'Este email no está registrado o la contraseña es erronea, intenta de nuevo.'
            ];
            return response($response, 401);
        }

        $token = $user->createToken('world-gamer-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

}