<?php

namespace Bluedot\Unit\Services;

use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use DateInterval;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Token
{
    protected Requester $requester;
    private Response $results;
    public function __construct()
    {
        $this->results = new Response();
        $this->requester = new Requester();
    }

    /**
     * @param int $userId
     * @return Token
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function createToken(int $userId): self
    {
        $expiration = new DateTime();
        $expiration->add(new DateInterval('P3D'));
        $expiration->setTimezone(new DateTimeZone('UTC'));

        $data = [
            "data" => [
                "type" => "apiToken",
                "attributes" => [
                    "description" => "Production token",
                    "scope" => "customers applications",
                    "expiration" => $expiration->format('Y-m-d\TH:i:s.v\Z')
                ]
            ]
        ];

        $this->requester->prepare(
            url: "users/$userId/api-tokens",
            method: Request::METHOD_POST,
            requestBody: $data
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response);

        return $this;
    }

    /**
     * @param int $userId
     * @return Token
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function getTokenList(int $userId): self
    {
        $this->requester->prepare(
           url: "users/$userId/api-tokens",
           method: Request::METHOD_GET,
           requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response);

        return $this;
    }

    /**
     * @return Response
     */
    public function getResults(): Response
    {
        return $this->results;
    }

    /**
     * @param Response $results
     * @return Token
     */
    public function setResults(Response $results): Token
    {
        $this->results = $results;
        return $this;
    }



}
