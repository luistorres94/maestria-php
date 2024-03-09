<?php

namespace App\Http\Controllers;

use App\Http\Requests\CambiaPasswordRequest;
use App\Http\Requests\editaUsuarioRequest;
use App\Http\Requests\nuevaUsuarioRequest;
use App\Models\User;
use App\Models\rol;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{
    public function authUser(){
        $usuario = Auth::user();
        return response()->json($usuario);
    }

    public function muestraUsuarios(){
        $usuarios = DB::select('exec sp_usuarios');
        return response()->json($usuarios);
    }

    public function muestraRoles(){
        $rolesUsuario = rol::all();
        return response()->json($rolesUsuario);
    }

    public function muestraUsuario($id){
        $usuario = User::find($id);
        return response()->json($usuario);
    }
    public function nuevoUsuario(nuevaUsuarioRequest $request){
        $usuario = new User([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => $request->password,
            'rol' => $request->rol,
        ]);
        $usuario->save();
        return response()->json(['success' => true],200);
    }


    public function editaUsuario(editaUsuarioRequest $request, $id){
        $usuario = User::find($id);
        if($usuario){
            $usuario->name = $request->name;
            $usuario->user_name = $request->user_name;
            $usuario->email = $request->email;
            $usuario->rol = $request->rol;
            $usuario->save();
            return response()->json(['success' => true],200);
        }
        
    }

    public function eliminaUsuario($id){
        $usuario = User::find($id); 
        if($usuario){
            $usuario->delete();
            return response()->json(['success' => true],200);
        }
    }
    public function cambiaContrasena(CambiaPasswordRequest $request){
        $usuario = User::find(auth()->user()->id);
        if($usuario){
            $usuario->password = Hash::make($request->password);
            $usuario->save();
            return response()->json(['success' => true],200);
        }
    }
    public function cierraSesion(){
        $usuario = Auth::user();
        $usuario->tokens()->delete();
        //Auth::logout();
        return response()->json(['success' => true],200);
    }
}
