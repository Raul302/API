<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;

// RUTAS APICONTROLLER
// Route.post('registrar', 'UserController.registrar')
// Route.post('iniciar', 'UserController.iniciar')
// Route.post('ejemplo', 'UserController.ejemplo')
// Route.get('cerrar', 'UserController.cerrar') .middleware(['auth:api'])
// Route.get('all','UserController.all').middleware(['auth:api','user'])

// Openweather
// Route::get('Ciudad', 'OpenweatherController@Ciudad');
Route::group(['prefix' => 'Github'], function() {
    Route::post('Start', 'GithubController@iniciarsesion');
    Route::post('Registrar', 'GithubController@registrarse');
    Route::group(['middleware' => ['auth:api']], function() {
    Route::get('close', 'GithubController@cerrarsesion');
    Route::post('BuscarUsuario','GithubController@Buscar');
    Route::post('BuscarRepos','GithubController@Repos');
    Route::post('CreateRepos','GithubController@CreateRepos');
    });
});

Route::post('Coordenadas', 'OpenweatherController@Coordenadas');
Route::group(['middleware' => ['auth:api']], function() {
    Route::get('Ciudad', 'OpenweatherController@Ciudad');
    Route::post('Coordenadas', 'OpenweatherController@Coordenadas');
});


Route::group(['prefix' => 'MARENTES'], function() {
    Route::post('iniciar', 'ConexionController@iniciarsesion');
    Route::post('registrar', 'ConexionController@registrarse');
    Route::group(['middleware' => ['auth:api']], function() {
    Route::get('close', 'ConexionController@cerrarsesion');
    });
    Route::group(['middleware' => ['auth:api']], function() {
        Route::get('all', 'ConexionController@Clima');
    });
});

Route::group(['prefix' => 'TOAPI'], function() {
    Route::post('iniciar', 'APICONTROLLER@iniciarsesion');
    Route::post('registrar', 'APICONTROLLER@registrarse');
    Route::group(['middleware' => ['auth:api']], function() {
    Route::get('close', 'APICONTROLLER@cerrarsesion');
    });
    Route::group(['middleware' => ['auth:api','user']], function() {
        Route::get('all', 'APICONTROLLER@Allusers');
    });
});



//FIN
Route::get('/',function(){
    return 'hola';
});

            // POST
Route::post('iniciar', 'UserController@iniciarsesion');
Route::post('registrar', 'UserController@registrarse');

            // GET
Route::group(['middleware' => ['auth:api']], function() {
    Route::get('cerrar', 'UserController@cerrarsesion');
});
Route::get('ejemplo', 'UserController@ejemplo');
Route::group(['middleware' => ['auth:api','user']], function() {
    Route::get('all', 'UserController@Allusers');
});

// routes test succesful

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

//  Route::middleware('auth:api')->get('/user', function (Request $request) {
//      return $request->user();
//  });

// Route::middleware('auth:api')->get('/logear', function (Request $request) {
//     return $request->user();

// });
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
