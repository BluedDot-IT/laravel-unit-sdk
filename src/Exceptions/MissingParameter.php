<?php

namespace BluedotDev\Unit\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class MissingParameter extends Exception
{
    public function __construct(array $errors)
    {

        $message = implode('', $errors);
        Log::error($message);

        parent::__construct($message);
    }
}
