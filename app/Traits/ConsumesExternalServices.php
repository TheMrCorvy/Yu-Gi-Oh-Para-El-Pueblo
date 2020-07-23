<?php

namespace App\Traits;

use GuzzleHttp\Client;

//desde aca se manejan todas las peticiones http

trait ConsumesExternalServices
{
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $isJsonRequest = false)
    {
        $client = new Client([
            'base_uri' => $this->baseUri, //$this->base_uri viene del objeto que haya llamado a este trait
        ]);

        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams,
        ]);

        // if ($isJsonRequest ) {  es lo de arriba, pero explicado para que no me olvide
        //     'json' => $formParams
        // }else {
        //     'form_params' => $formParams,
        // }

        $response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeResponse')) {
            $response = $this->decodeResponse($response);
        }

        return $response;
    }
}
