<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(LoginRequest $request){
        $datos = $request->validated();

        if(!Auth::attempt($datos)){
            return response()->json(['errors' =>  ['noLogin' =>'Usuario y/o contraseña incorrectos']],401);
        }
        $usuario = Auth::user();
        return [
            'token' => $usuario->createToken('API-TOKEN')->plainTextToken,
            'usuario' => $usuario
        ];
        
    }
}
