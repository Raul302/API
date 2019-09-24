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
        // $usuario = new App\User();
        $usuario= new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $usuario->save();
        return response()->json(['message' =>'Usuario creado con exito'],201);
                    // test succesful

    }
    
    public function iniciarsesion(Request $request)
    {
        $credentials = request(['email', 'password']);
                // Auth::once
        if (!Auth::once($credentials))
        {
            return response()->json([
                'message' => 'Usuario y/o contraseñas invalidas'], 401);
                // abort(401);
        }
        $token = Str::random(60);
        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return response()->json(['token' => $token],201);
                    // test succesful

    }
    public function cerrarsesion(Request $request)
    {
        // $request->user()->forceFill([
        //     'api_token' => null,
        // ])->save();
        // \abort(204);   -> tomar funcion especifica
        
        $id = $request->user()->id;
        $usuario= User::find($id);
        $usuario['api_token']=null;
        $usuario->save();
          return response()->json(['message' => 
            'Sesion cerrada exitosamente']);

            // With passport
            // $user = Auth::user()->token();
            // $user->revoke();
            // return 'logged out'; //modify as per your need
            // test succesful

    }
    public function Allusers()
    {
        $users= User::all();
        return $users;
        // return resonse()->json(["usuarios" =>$users],200);
      // test succesful

    }
    public function ejemplo()
    {
        $client = new \GuzzleHttp\Client(['base_uri'=>'http://127.0.0.1:3333/']);

        $response = $client->request('POST','ejemplo');

        return $response->getBody();
    }
}
