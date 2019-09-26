<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
    
class APICONTROLLER extends Controller
{
    public function registrarse(Request $request)
    {
        $usuario= new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $usuario->save();

            $body = ["email"=>$request->email,"password"=>$request->password,"username"=>$request->username];
            $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:3333/']);
            $response = $client->post('http://127.0.0.1:3333/registrar',
            [
                'form_params' => $body
            ]);
            return $response->getBody();
        

    }
    
    public function iniciarsesion(Request $request)
    {
        $body = ["email"=>$request->email,"password"=>$request->password,"username"=>$request->username];
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:3333/']);
        $response = $client->post('http://127.0.0.1:3333/iniciar',
        [
            'form_params' => $body
        ]);
        $credentials = request(['email', 'password']);
                // Auth::once
        if (!Auth::once($credentials))
        {
            return response()->json([
                'message' => 'Usuario y/o contraseñas invalidas'], 401);
                // abort(401);
        }
        $token = Str::random(60);
        $var= $response->getBody();
        $request->user()->forceFill([
            'token_api' => $var,
            'api_token' => hash('sha256', $token),
        ])->save();

        return response()->json(['token' => $token],201);

    }
    public function cerrarsesion(Request $request)
    {
        $id = $request->user()->id;
        $usuario= User::find($id);
        $token_api =$request->user()->token_api;
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:3333/']);
        $headers = [
            'Authorization' => 'Bearer ' . $token_api,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'http://127.0.0.1:3333/cerrar', [
            'headers' => $headers
        ]);
        $usuario['api_token']=null;
        $usuario['token_api']=null;
        $usuario->save();
                  return response()->json(['message' => 
            'Sesion cerrada exitosamente']);
//         <!-- Route.post('registrar', 'UserController.registrar')
// Route.post('iniciar', 'UserController.iniciar')
// Route.post('ejemplo', 'UserController.ejemplo')
// Route.get('cerrar', 'UserController.cerrar') .middleware(['auth:api'])
// Route.get('all','UserController.all').middleware(['auth:api','user']) -->

    }
    public function Allusers(Request $request)
    {
        $id = $request->user()->id;
        $usuario= User::find($id);
        $token_api =$request->user()->token_api;
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:3333/']);
        $headers = [
            'Authorization' => 'Bearer ' . $token_api,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'http://127.0.0.1:3333/all', [
            'headers' => $headers
        ]);
        return $response->getBody();


    }
    public function ejemplo()
    {
        $client = new \GuzzleHttp\Client(['base_uri'=>'http://127.0.0.1:3333/']);

        $response = $client->request('POST','ejemplo');

        return $response->getBody();
    }
}
