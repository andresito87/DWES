<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\RequestOptions;

function enviarArchivoAVerificar($nombrearchivo, $tipoMime)
{
        $client = new Client(['http_errors' => false]);
        $response = $client->request('POST', 'https://www.virustotal.com/api/v3/files', [
                'headers' => [
                        'accept' => 'application/json',
                        'x-apikey' => VIRUS_TOTAL_API_KEY,
                        'verify' => false
                ],
                'multipart' => [
                        [
                                'name' => 'file',
                                'filename' => $nombrearchivo,
                                'contents' => Utils::tryFopen($nombrearchivo, 'r'),
                                'headers' => [
                                        'Content-Type' => $tipoMime
                                ]
                        ]
                ]
        ]);

        return $response;
}

function obtenerEstadoVerificacion($hash256)
{
        $client = new Client(['http_errors' => false]);
        $response = $client->request('GET', 'https://www.virustotal.com/api/v3/files/' . $hash256, [
                'headers' => [
                        'accept' => 'application/json',
                        'x-apikey' => VIRUS_TOTAL_API_KEY,
                        'verify' => false
                ]
        ]);

        return $response;
}
