<?php

namespace BluedotDev\Unit\Classes;

use BluedotDev\Unit\Client;
use BluedotDev\Unit\Contracts\AccountServiceInterface;
use BluedotDev\Unit\Contracts\TokenServiceInterface;
use BluedotDev\Unit\Contracts\TransactionServiceInterface;
use BluedotDev\Unit\Services\AccountService;
use BluedotDev\Unit\Services\TokenService;
use BluedotDev\Unit\Services\TransactionService;

class ClientBuilder {

    private TokenServiceInterface|null $tokenService;
    private AccountServiceInterface|null $accountService;
    private TransactionServiceInterface|null $transactionService;

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

    public function setTransactionService(TransactionServiceInterface $transactionService = null): self
    {
        $service = new TransactionService();
        if ( !is_null($transactionService) ){
            $service = $transactionService;
        }
        $this->transactionService = $service;
        return $this;
    }


    public function build(): Client
    {
        return new Client(
            $this->tokenService,
            $this->accountService,
            $this->transactionService
        );
    }
}
