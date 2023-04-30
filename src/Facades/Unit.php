<?php

namespace Bluedot\Unit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @author Taner Tombas <taner@thebluedot.co>
 * @version 1.1
 *
 * @method static createToken(int $userId):Response
 * @method static getTokenList(int $userId):Response
 */
class Unit extends Facade {
    protected static function getFacadeAccessor(): string
    {
        return 'BluedotUnitClient';
    }
}
