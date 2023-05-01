<?php
namespace Bluedot\Unit;

use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Contracts\AccountServiceInterface;
use Bluedot\Unit\Contracts\ClientInterface;
use Bluedot\Unit\Contracts\TokenServiceInterface;

class Client implements ClientInterface {
    private TokenServiceInterface $tokenService;
    private AccountServiceInterface $accountService;

    public function __construct(
        TokenServiceInterface $tokenService,
        AccountServiceInterface $accountService
    ) {
        $this->tokenService = $tokenService;
        $this->accountService = $accountService;
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

    public function getAccounts(): Response
    {
        $accountList = $this->accountService->getAccounts();
        return $accountList->getResults();
    }
}
