<?php

namespace App\Clients;

use GuzzleHttp\Client;

class GoRestClient extends Client
{
    public function __construct()
    {
        parent::__construct(
            [
                'base_uri'        => env('GOREST_API_URL'),
                'headers' => [
                    'Authorization' => 'Bearer ' . env('GOREST_API_HEADER_AUTH'),
                    //'Content-Type' => 'application/json'
                ]
            ]
        );
    }

    static public function prefix(): string
    {
        return 'aW5pY2ll_';
    }
}
