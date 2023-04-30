<?php

namespace Bluedot\Unit\Abstracts;

use Bluedot\Unit\Abstracts\Client as ClientAbstract;
use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Contracts\ClientInterface;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use Bluedot\Unit\Requester;
use Illuminate\Http\Request;

abstract class Client implements ClientInterface
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
     * @param string|null $url
     * @param array|null $headers
     * @return ClientAbstract
     *
     * @throws MethodNotAllowed
     */
    public function get(?string $url, ?array $headers): self
    {
        $this->setHeaders([
            "content-type" => "application/vnd.api+json"
        ]);

        if ( !is_null($headers) ) {
            $this->setHeaders(array_merge($this->getHeaders(), $headers));
        }

        $this->getRequester()->prepare(
            method: Request::METHOD_GET,
            url: config('bluedot-unit.base-url')."/".$url,
            headers: $headers
        );

        $result = $this->getRequester()->sendRequest();
        $this->getResponse()
            ->setResponseBody($result)
            ->parse();

        return $this;
    }



    public function post(?string $url, ?array $requestBody, ?array $headers): self
    {
        // will implement

        return $this;
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
