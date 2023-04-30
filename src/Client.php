<?php
namespace Bluedot\Unit;

use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Contracts\ClientInterface;
use Bluedot\Unit\Contracts\TokenServiceInterface;

class Client implements ClientInterface {
    private TokenServiceInterface $tokenService;

    public function __construct(TokenServiceInterface $tokenService) {
        $this->tokenService = $tokenService;
    }

    public function createToken(int $userId): Response
    {
        $createToken = $this->tokenService->createToken($userId);
        return $createToken->getResults();
    }

    public function getTokenList(int $userId): Response
    {
        $tokenList = $this->tokenService->getTokenList($userId);
        return $tokenList->getResults();
    }

}
