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
}
