<?php

namespace Bluedot\Unit\Facades;

use Illuminate\Support\Facades\Facade;
class ClientFacade extends Facade {
    protected static function getFacadeAccessor(): string
    {
        return "ClientFacade";
    }
}
