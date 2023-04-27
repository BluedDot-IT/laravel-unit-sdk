<?php

use Illuminate\Http\Request;

return [
    "base-url" => "",
    "Allowed-methods" => [
        Request::METHOD_POST, Request::METHOD_GET
    ],
    "content-type" => "application/vnd.api+json"

];
