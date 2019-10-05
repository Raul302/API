<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;

class GithubController extends Controller
{
    public function registrarse(Request $request)
    {

        $usuario= new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $usuario->save();
        return response()->json(['message' => 'Usuario creado con exito'],201);

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
                    // b6a019665faa392aef2d329eca584634469b6120
            }
            $token = Str::random(60);
            $request->user()->forceFill([
                'api_token' => hash('sha256', $token),
                'Github' => 'b6a019665faa392aef2d329eca584634469b6120'
            ])->save();

            return response()->json(['token' => $token],201);
    }
    public function cerrarsesion(Request $request)
    {
        $id = $request->user()->id;
        $usuario= User::find($id);
        $usuario['api_token']=null;
        $usuario['Github']=null;
        $usuario->save();
          return response()->json(['message' => 
            'Sesion cerrada exitosamente']);
    }
    public function Buscar(Request $request)
    {
        $buscar = $request ->Busqueda;
        $Github = $request->user()->Github;
        $client = new \GuzzleHttp\Client(['base_uri' => 'api.github.com/search/']);
        $headers = [
            'Authorization' => 'Bearer ' . $Github,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'users?q='.$buscar.'',
         [
            // e9ec8a20345b35806fe60ef003d20cf1
        ]);
        return $response->getBody();
    }
    public function Repos(Request $request)
    {
        $buscar = $request ->Busqueda;
        $Github = $request->user()->Github;
        $client = new \GuzzleHttp\Client(['base_uri' => 'api.github.com/search/']);
        $headers = [
            'Authorization' => 'Bearer ' . $Github,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'repositories?q='.$buscar.'',
         [
            // e9ec8a20345b35806fe60ef003d20cf1
        ]);
        return $response->getBody();
    }
    public function CreateRepos(Request $request)
    {
        $buscar = $request ->Busqueda;
        $Github = $request->user()->Github;
        $body = ["name"=>$request->name,"description"=>$request->description,"homepage"=>$request->homepage];
        $client = new \GuzzleHttp\Client(['base_uri' => 'api.github.com/']);
        $headers = [
            'Authorization' => 'Bearer ' . $Github,        
            'Accept'        => 'application/json',
        ];
        $response = $client->request('POST', 'Raul302/repos',
         [
            ['form_params'] => JSON($body),
            'headers' => $headers
            // e9ec8a20345b35806fe60ef003d20cf1
        ]);
        return $response->getBody();
    }

}
