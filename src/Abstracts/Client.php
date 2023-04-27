<?php

namespace Bluedot\Unit\Abstracts;

use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Requester;

abstract class Client
{
    private Requester $requester;
    private Response $response;
    private array $headers;
    public function __construct()
    {
        $this->setRequester(new Requester());
        $this->setResponse(new Response());
    }

    /**
     * @return Requester
     */
    public function getRequester(): Requester
    {
        return $this->requester;
    }

    /**
     * @param Requester $requester
     * @return Client
     */
    public function setRequester(Requester $requester): self
    {
        $this->requester = $requester;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return Client
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return Client
     */
    public function setResponse(Response $response): Client
    {
        $this->response = $response;
        return $this;
    }

}
