<?php

namespace BluedotDev\Unit\Services;

use BluedotDev\Unit\Contracts\FeeServiceInterface;
use BluedotDev\Unit\Exceptions\MethodNotAllowed;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class FeeService extends Service implements FeeServiceInterface {
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @param int $amount
     * @param string $description
     * @param string $accountId
     * @param string|null $idempotencyKey
     * @return FeeService
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function createFee(int $amount, string $description, string $accountId, ?string $idempotencyKey = null): self
    {
        $requestBody = [
            "data" => [
                "type" => "fee",
                "attributes" => [
                    "amount" => $amount,
                    "description" => $description,
                ],
                "relationships" => [
                    "account" => [
                        "data" => [
                            "type" => "depositAccount",
                            "id" => $accountId
                        ]
                    ]
                ]
            ]
        ];

        if ($idempotencyKey !== null) {
            $requestBody['data']['attributes']['idempotencyKey'] = $idempotencyKey;
        }

        $this->requester->prepare(
            url: "fees",
            method: Request::METHOD_POST,
            requestBody : $requestBody
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'feeOption');

        return $this;
    }

    /**
     * @param int $amount
     * @param string $description
     * @param string $accountId
     * @param string $transactionId
     * @return FeeServiceInterface
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function reverseFee(int $amount, string $description, string $accountId, string $transactionId): FeeServiceInterface
    {

        $requestBody = [
            "data" => [
                "type" => "feeReversal",
                "attributes" => [
                    "amount" => $amount,
                    "description" => $description
                ],
                "relationships" => [
                    "account" => [
                        "data" => [
                            "type" => "depositAccount",
                            "id" => $accountId
                        ]
                    ],
                    "transaction" => [
                        "data" => [
                            "type" => "transaction",
                            "id" => $transactionId
                        ]
                    ]
                ]
            ]
        ];

        $this->requester->prepare(
            url: "fees/reverse",
            method: Request::METHOD_POST,
            requestBody : $requestBody
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'feeOption');

       return $this;
    }
}
