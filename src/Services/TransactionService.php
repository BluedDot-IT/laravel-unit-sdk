<?php

namespace BluedotDev\Unit\Services;

use BluedotDev\Unit\Contracts\TransactionServiceInterface;
use BluedotDev\Unit\Exceptions\MethodNotAllowed;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class TransactionService extends Service implements TransactionServiceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return TransactionService
     * @throws MethodNotAllowed
     * @throws GuzzleException
     */
    public function getList(): self
    {
        $this->requester->prepare(
            url: "transactions",
            method: Request::METHOD_GET,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, "transactionLists");


        return $this;
    }

    /**
     * @param string $accountId
     * @param string $transactionId
     * @return TransactionServiceInterface
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function getById(string $accountId, string $transactionId): TransactionServiceInterface
    {
        $this->requester->prepare(
            url: "accounts/$accountId/transactions/$transactionId",
            method: Request::METHOD_GET,
            requestBody: null
        );
        $response = $this->requester->sendRequest();
        $this->results->parse($response, "getTransaction");

        return $this;
    }
}
