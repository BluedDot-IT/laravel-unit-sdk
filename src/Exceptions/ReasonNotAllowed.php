<?php

namespace BluedotDev\Unit\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ReasonNotAllowed extends Exception
{
    public function __construct($reason = "PUT")
    {
        $message = $reason. " reason is not allowed on UNIT SDK";
        Log::error($message);

        parent::__construct($message);
    }
}
