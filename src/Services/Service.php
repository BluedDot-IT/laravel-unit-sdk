<?php

namespace BluedotDev\Unit\Services;

use BluedotDev\Unit\Classes\Requester;
use BluedotDev\Unit\Classes\Response;
use Illuminate\Database\Eloquent\Model;

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
     * @return Model|Response
     */
    public function getResults(): Model|Response
    {
        return $this->results->toModel();
    }
}
