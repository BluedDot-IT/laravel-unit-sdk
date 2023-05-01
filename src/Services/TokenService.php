<?php

namespace Bluedot\Unit\Services;

use Bluedot\Unit\Classes\Requester;
use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Contracts\TokenServiceInterface;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use DateInterval;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class TokenService extends Service implements TokenServiceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $userId
     * @return TokenService
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
     * @return TokenService
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
}
