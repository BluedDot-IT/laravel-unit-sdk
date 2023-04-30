<?php

namespace Bluedot\Unit\Classes;

use Bluedot\Unit\Client;
use Bluedot\Unit\Contracts\TokenServiceInterface;
use Bluedot\Unit\Services\TokenService;

class ClientBuilder {

    private TokenServiceInterface|null $tokenService;

    public function setTokenService(TokenServiceInterface $tokenService = null): self
    {
        $service = new TokenService();

        if ( !is_null($tokenService) ){
            $service = $tokenService;
        }

        $this->tokenService = $service;

        return $this;
    }

    public function build(): Client
    {
        return new Client($this->tokenService);
    }
}
