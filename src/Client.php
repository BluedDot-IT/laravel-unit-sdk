<?php
namespace Bluedot\Unit;

use Bluedot\Unit\Abstracts\Client as ClientAbstract;
use Bluedot\Unit\Exceptions\ApplicationNotWorking;

class Client extends ClientAbstract
{
    /**
     * @throws ApplicationNotWorking
     */
    public function __construct()
    {
        throw new ApplicationNotWorking("Package not implement yet");
    }
}
