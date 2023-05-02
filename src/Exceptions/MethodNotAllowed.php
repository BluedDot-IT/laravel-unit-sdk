<?php

namespace BluedotDev\Unit\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class MethodNotAllowed extends Exception
{
    public function __construct($method = "PUT")
    {
        $message = $method. " is not allowed on SDK";
        Log::error($message);

        parent::__construct($message);
    }
}
