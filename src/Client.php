<?php
namespace Bluedot\Unit;

use Bluedot\Unit\Abstracts\Client as ClientAbstract;
use Bluedot\Unit\Contracts\ClientInterface;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use Illuminate\Http\Request;

class Client extends ClientAbstract implements ClientInterface
{
    public function __construct()
    {
        parent::__construct();
    }
}
