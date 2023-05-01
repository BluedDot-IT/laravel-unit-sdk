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

    /**
     * @param int $userId
     * @return Response
     */
    public function createToken(int $userId): Response
    {
        $createToken = $this->tokenService->createToken($userId);
        return $createToken->getResults();
    }

    /**
     * @param int $userId
     * @return Response
     */
    public function getTokenList(int $userId): Response
    {
        $tokenList = $this->tokenService->getTokenList($userId);
        return $tokenList->getResults();
    }

    /**
     * @return Response
     */
    public function getAccounts(): Response
    {
        $accountList = $this->accountService->getAccounts();
        return $accountList->getResults();
    }

    /**
     * @param array $data
     * @param string $customerId
     * @return Response
     */
    public function createAccount(array $data, string $customerId): Response
    {
        $accountList = $this->accountService->createAccount($data, $customerId);
        return $accountList->getResults();
    }

    /**
     * @param array|null $data
     * @param string $accountId
     * @return Response
     */
    public function closeAccount(?array $data, string $accountId): Response
    {
       $closeAccount = $this->accountService->closeAccount($data, $accountId);
       return $closeAccount->getResults();
    }

    /**
     * @param string $accountId
     * @return Response
     */
    public function reopenAccount(string $accountId): Response
    {
       $closeAccount = $this->accountService->reopenAccount($accountId);
       return $closeAccount->getResults();
    }

    /**
     * @param array|null $data
     * @param string $accountId
     * @return Response
     */
    public function freezeAccount(?array $data, string $accountId): Response
    {
        $closeAccount = $this->accountService->freezeAccount($data, $accountId);
        return $closeAccount->getResults();
    }

    /**
     * @param string $accountId
     * @return Response
     */
    public function unfreezeAccount(string $accountId): Response
    {
        $closeAccount = $this->accountService->unfreezeAccount($accountId);
        return $closeAccount->getResults();
    }
}
