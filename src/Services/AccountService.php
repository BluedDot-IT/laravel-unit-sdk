<?php

namespace Bluedot\Unit\Services;

use Bluedot\Unit\Contracts\AccountServiceInterface;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use Bluedot\Unit\Exceptions\ReasonNotAllowed;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AccountService extends Service implements AccountServiceInterface
{
    const CLOSE_REASONS = [
        "ByCustomer", "Fraud", "NegativeBalance",
        "ACHActivity", "CardActivity", "CheckActivity",
        "ApplicationHistory", "AccountActivity", "ClientIdentified",
        "IdentityTheft", "LinkedToFraudulentCustomer"
    ];

    const FREEZE_REASONS = [ "Other", "Fraud" ];
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
        $this->results->parse($response, "accountLists");

        return $this;
    }

    /**
     * @param array|null $data
     * @param string $customerId
     * @return AccountService
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function createAccount(?array $data, string $customerId): AccountServiceInterface
    {
        $requestBody = [
            "data" => [
                "type" => isset($data['type']) ? $data['type'] : 'depositAccount',
                "attributes" => [
                    "depositProduct" => isset($data["depositProduct"]) ? $data["depositProduct"] : "checking",
                    "tags" => [
                        "purpose" => isset($data["tags"]["purpose"]) ? $data["tags"]["purpose"] : "checking"
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
            requestBody: $requestBody
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountOption');

        return $this;
    }

    /**
     * @param array|null $data
     * @param string $accountId
     * @return self
     * @throws GuzzleException
     * @throws MethodNotAllowed
     * @throws ReasonNotAllowed
     */
    public function closeAccount(?array $data, string $accountId): AccountServiceInterface
    {

        if ( isset($data['reason']) &&
            !in_array($data['reason'], self::CLOSE_REASONS) ){
            throw new ReasonNotAllowed($data['reason']);
        }

        $requestBody = [
            "data" => [
                "type" => isset($data["type"]) ? $data["type"] : "depositAccountClose",
                "attributes" => [
                    "reason" => isset($data["reason"]) ? $data["reason"] : "ByCustomer"
                ]
            ]
        ];

        $this->requester->prepare(
            url: "accounts/$accountId/close",
            method: Request::METHOD_POST,
            requestBody: $requestBody
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountOption');

        return $this;
    }

    /**
     * @param string $accountId
     * @return self
     * @throws MethodNotAllowed
     * @throws GuzzleException
     */
    public function reopenAccount(string $accountId): AccountServiceInterface
    {

        $this->requester->prepare(
            url: "accounts/$accountId/reopen",
            method: Request::METHOD_POST,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountOption');

        return $this;
    }

    /**
     * @param array|null $data
     * @param string $accountId
     * @return self
     * @throws GuzzleException
     * @throws MethodNotAllowed
     * @throws ReasonNotAllowed
     */
    public function freezeAccount(?array $data, string $accountId): AccountServiceInterface
    {
        if ( isset($data['reason']) &&
            !in_array($data['reason'], self::FREEZE_REASONS) ){
            throw new ReasonNotAllowed($data['reason']);
        }

        $requestBody = [
            "data" => [
                "type" => isset($data["type"]) ? $data["type"] : "accountFreeze",
                "attributes" => [
                    "reason" => isset($data["reason"]) ? $data["reason"] : "Other",
                    "reasonText" => isset($data["reason_text"]) ? $data["reason_text"] : "Default freeze message"
                ]
            ]
        ];

        if ( isset($data["reason_text"]) ){
            $requestBody['data']["attributes"]["reason_text"] = $data["reason_text"];
        }

        $this->requester->prepare(
            url: "accounts/$accountId/freeze",
            method: Request::METHOD_POST,
            requestBody: $requestBody
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountOption');

        return $this;
    }

    /**
     * @param string $accountId
     * @return self
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function unfreezeAccount(string $accountId): AccountServiceInterface
    {
        $this->requester->prepare(
            url: "accounts/$accountId/unfreeze",
            method: Request::METHOD_POST,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountOption');

        return $this;
    }

    /**
     * @param string $accountId
     * @return AccountService
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function getById(string $accountId): AccountServiceInterface
    {
        $this->requester->prepare(
            url: "accounts/$accountId",
            method: Request::METHOD_GET,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountOption');

        return $this;
    }

    /**
     * @param string $accountId
     * @return AccountService
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function limits(string $accountId): AccountServiceInterface
    {
        $this->requester->prepare(
            url: "accounts/$accountId/limits",
            method: Request::METHOD_GET,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, 'accountLimit');

        return $this;
    }

}
