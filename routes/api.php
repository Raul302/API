<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// // Route::middleware('auth:api')->get('/user', function (Request $request) {
// // });

Route::middleware('auth:api')->get('/logear', function (Request $request) {
    return $request->user();

});
Route::post('iniciarsesion', 'UserController@iniciarsesion');
Route::post('registrarse', 'UserController@registrarse');
Route::get('cerrarsesion', 'UserController@cerrarsesion');
Route::get('Allusers', 'UserController@Allusers');

// Route::post('/generartoken',function(){
//     $token = Str::random(60);

//     $User = App\User::find(1);

//     $User['api_token'] =hash('sha256', $token);

//     $User->save();
    
//     return $token;
// });
// lRerWCdRa6ZpRkTyoPOCHy7eupqjF8TAQ9oS5avRx2gmQxbRI6hpTY0vYwz0

// Use illuminate SUPOORT STR;
// $User = App slash User::find(1);
// return $user;
// Migracion,Seeder,Brincar middleware,Guardar en BD
