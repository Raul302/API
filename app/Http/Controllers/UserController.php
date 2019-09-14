<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
    public function registrarse(Request $request)
    {
        // Valideishon(Opcional)
     
        
        $usuario= new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash('sha256', $request->password)
        ]);

        $usuario->save();
        return response()->json(['message' =>'Usuario creado con exito'],201);
    }
    
    public function iniciarsesion(Request $request)
    {

        $credentials = request(['email', 'password']);
        if(!Auth::once($credentials))
        {
         return response()->json(['message' =>'Usuario y/o password invalido'],404);

        }
                // Auth::once
      
    //    $usuario=User::where('email',$request->email)->first();

    //     if(!$usuario){
    //         return response()->json(['message'=>'Usuario inexistente'],404);
    //     }
    //     if(Hash::check($request->password,$usuario->password))
    //     {          
    //          $credentials = request(['email', 'password']);
    //         $auth=Auth::once($credentials);
    //         return response()->json(['message' =>$auth],201);
           
    //     }
    //    return $usuario;

        
    }
}
