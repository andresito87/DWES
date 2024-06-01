<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\RequestOptions;

function enviarArchivoAVerificar($nombrearchivo,$tipo)
{
    $client = new Client(['http_errors' => false]);
    $response = $client->post('https://www.virustotal.com/api/v3/files', [
        'verify' => false, 
        'headers' => [
            'accept' => 'application/json',
            'x-apikey' => VIRUS_TOTAL_API_KEY
        ],
        'multipart' => [
            [
                'name'     => 'file',
                'filename' => $nombrearchivo,
                'contents' => Utils::tryFopen($nombrearchivo, 'r'),
                'headers' => [
                    'Content-Type' => $tipo
                ]
            ]
        ]
    ]);

    $status_code = $response->getStatusCode();
    $body = json_decode($response->getBody()->getContents());
    return ["status" => $status_code, "content" => $body];
}

function obtenerEstadoVerificacion($id)
{
    $client = new \GuzzleHttp\Client(['http_errors' => false]);

    $response = $client->request('GET', 'https://www.virustotal.com/api/v3/files/'.urlencode($id), [
        'verify' => false, 
        'headers' => [
            'accept' => 'application/json',
            'x-apikey' => VIRUS_TOTAL_API_KEY,
        ],
    ]);

    $status_code = $response->getStatusCode();
    $body = json_decode($response->getBody()->getContents());
    return ["status" => $status_code, "content" => $body];
}
