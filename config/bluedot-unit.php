<?php

use Illuminate\Http\Request;

return [
    "api" => [
        "base_uri" => "https://api.s.unit.sh/"
    ],
    "Allowed-methods" => [
        Request::METHOD_POST, Request::METHOD_GET
    ],
    "content-type" => "application/vnd.api+json"

];
