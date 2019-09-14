<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;


class UserController extends Controller
{
    public function registrarse(Request $request)
    {
        // Valideishon(Opcional)
     
        
        $usuario= new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $usuario->save();
        return response()->json(['message' =>'Usuario creado con exito'],201);
    }
    
    public function iniciarsesion(Request $request)
    {
        $token = Str::random(60);
        $credentials = request(['email', 'password']);
                // Auth::once
        if (!Auth::once($credentials))
        {
            return response()->json([
                'message' => 'Usuario y/o contraseñas invalidas'], 401);
        }
        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return response()->json(['token' => $token],200);
    }
    public function cerrarsesion(Request $request)
    {
        $id = $request->user()->id;
        $usuario= User::find($id);
        $usuario['api_token']='';
        $usuario->save();
          return response()->json(['message' => 
            'Sesion cerrada exitosamente']);
    }
    public function Allusers()
    {
        $user= User::all();
        return $user;
    }
}
