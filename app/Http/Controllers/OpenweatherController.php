<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenweatherController extends Controller
{
    // api.openweathermap.org/data/2.5/weather?q=London
    public function Ciudad(Request $request)
    {
        $cityname = $request->city;
        $client = new \GuzzleHttp\Client(['base_uri' => 'api.openweathermap.org/data/2.5/']);
        
        $response = $client->request('GET', 'weather?q='.$cityname.'&appid=e9ec8a20345b35806fe60ef003d20cf1',
         [
            // e9ec8a20345b35806fe60ef003d20cf1
        ]);
        return $response->getBody();
    }
    public function Coordenadas(Request $request)
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
