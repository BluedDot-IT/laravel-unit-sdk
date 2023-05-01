<?php

namespace Bluedot\Unit\Classes;

use Bluedot\Unit\Client;
use Bluedot\Unit\Contracts\AccountServiceInterface;
use Bluedot\Unit\Contracts\TokenServiceInterface;
use Bluedot\Unit\Services\AccountService;
use Bluedot\Unit\Services\TokenService;

class ClientBuilder {

    private TokenServiceInterface|null $tokenService;
    private AccountServiceInterface|null $accountService;

    public function setTokenService(TokenServiceInterface $tokenService = null): self
    {
        $service = new TokenService();
        if ( !is_null($tokenService) ){
            $service = $tokenService;
        }
        $this->tokenService = $service;
        return $this;
    }

    public function setAccountService(AccountServiceInterface $accountService = null): self
    {
        $service = new AccountService();
        if ( !is_null($accountService) ){
            $service = $accountService;
        }
        $this->accountService = $service;
        return $this;
    }


    public function build(): Client
    {
        return new Client(
            $this->tokenService,
            $this->accountService
        );
    }
}
