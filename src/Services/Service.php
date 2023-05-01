<?php

namespace Bluedot\Unit\Services;

use Bluedot\Unit\Classes\Requester;
use Bluedot\Unit\Classes\Response;

class Service
{
    protected Requester $requester;
    protected Response $results;
    public function __construct()
    {
        $this->results = new Response();
        $this->requester = new Requester();
    }



    /**
     * @return Response
     */
    public function getResults(): Response
    {
        return $this->results;
    }
}
