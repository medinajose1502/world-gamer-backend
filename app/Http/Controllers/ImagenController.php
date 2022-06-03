<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ImagenController extends Controller
{
    public function perfil(Request $request){

        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:jpg,jpeg,png,webp,bmp,tiff|max:4096'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }

        if($file = $request->file('file')){
            $file = $request->file->store('public/perfiles');

            $user = User::findOrFail(Auth::id());
            $user->imagen = $file;
            $user->save();

            return response()->json([
                'mensaje' => 'La imagen fue subida con éxito.',
                'file' => $file
            ]);
        }


    }

    public function publicacion(Request $request){

        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:jpg,jpeg,png,webp,bmp,tiff|max:4096'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }

        if($file = $request->file('file')){
            $file = $request->file->store('public/publicacion');

            return response()->json([
                'mensaje' => 'La imagen fue subida con éxito.',
                'file' => $file
            ]);
        }
    }

}