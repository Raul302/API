<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
}
