<?php

use Illuminate\Http\Request;

return [
    "api" => [
        "base_uri" => env("BLUEDOT_DEV_UNIT_BASE_URL", "https://api.s.unit.sh/"),
        'auth-token' => env("BLUEDOT_DEV_UNIT_API_TOKEN"),
        "content-type" => "application/vnd.api+json"
    ],
    "Allowed-methods" => [
        Request::METHOD_POST, Request::METHOD_GET,Request::METHOD_PUT
    ]

];
