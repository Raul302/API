<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConexionController extends Controller
{
    public function registrarse(Request $request)
    {
        // $usuario= new User([
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password)
        // ]);
        // $usuario->save();
        // return response()->json(['message' =>'Usuario creado con exito'],201);
        return $request.all();

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

    }
    public function cerrarsesion(Request $request)
    {
        $id = $request->user()->id;
        $usuario= User::find($id);
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
    public function Clima(Request $request)
    {
        $latitud = $request->latitud;
        $longitud = $request->longitud;
        $client = new \GuzzleHttp\Client(['base_uri' => 'api.openweathermap.org/data/2.5/']);
        $response = $client->request('GET', 'weather?lat='.$latitud.'&lon='.$longitud.'&appid=e9ec8a20345b35806fe60ef003d20cf1',
         [
            // e9ec8a20345b35806fe60ef003d20cf1
        ]);
        return $response->getBody();


    }
}
