<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use GuzzleHttp\Client;

class TestController extends Controller
{
    public function getDatas() {
        $response = Http::get('https://app.moussemyanmar.com/api/products?populate=*&pagination[page]=1&pagination[pageSize]=100');
        $jsonObj = $response->object();
        return $jsonObj;


        // $client = new Client();
        // $response = $client->request('GET', 'https://app.moussemyanmar.com/api/products?populate=*&pagination[page]=1&pagination[pageSize]=100');

        // $response->getStatusCode(); // 200
        // $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        // $body = $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
        // return json_decode($body);

        // return [
        //     'id' => 123,
        //     'name' => 'hha'
        // ];
    }
}
