<?php

namespace Bluedot\Unit\Services;

use Bluedot\Unit\Contracts\AccountServiceInterface;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AccountService extends Service implements AccountServiceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws MethodNotAllowed
     * @throws GuzzleException
     * TODO: we need to paginate..
     */
    public function getAccounts(): self
    {
        $this->requester->prepare(
            url: "accounts",
            method: Request::METHOD_GET,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response);

        return $this;
    }

    /**
     * @throws MethodNotAllowed
     * @throws GuzzleException
     */
    public function createAccount(array $data, string $customerId): self
    {
        $data = [
            "data" => [
                "type" => $data['type'] ?? 'depositAccount',
                "attributes" => [
                    "depositProduct" => $data["depositProduct"] ?? "checking",
                    "tags" => [
                        "purpose" => $data["tags"]["purpose"] ?? "checking"
                    ],
                    "idempotencyKey" => \Str::random(35)
                ],
                "relationships" => [
                    "customer" => [
                        "data" => [
                            "type" => "customer",
                            "id" => $customerId
                        ]
                    ]
                ]
            ]
        ];

        $this->requester->prepare(
            url: "accounts",
            method: Request::METHOD_POST,
            requestBody: $data
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response);

        return $this;
    }
}
