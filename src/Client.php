<?php
namespace Bluedot\Unit;

use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Contracts\AccountServiceInterface;
use Bluedot\Unit\Contracts\ClientInterface;
use Bluedot\Unit\Contracts\TokenServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @TODO :: need here exception handling mechanism
 * */
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
     * @return Model
     */
    public function createToken(int $userId): Model
    {
        $createToken = $this->tokenService->createToken($userId);
        return $createToken->getResults();
    }

    /**
     * @param int $userId
     * @return Model
     */
    public function getTokenList(int $userId): Model
    {
        $tokenList = $this->tokenService->getTokenList($userId);
        return $tokenList->getResults();
    }

    /**
     * @return Model|Response
     */
    public function getAccounts(): Model|Response
    {
        $accountList = $this->accountService->getAccounts();
        return $accountList->getResults();
    }

    /**
     * @param array $data
     * @param string $customerId
     * @return Model
     */
    public function createAccount(array $data, string $customerId): Model
    {
        $accountList = $this->accountService->createAccount($data, $customerId);
        return $accountList->getResults();
    }

    /**
     * @param array|null $data
     * @param string $accountId
     * @return Model
     */
    public function closeAccount(?array $data, string $accountId): Model
    {
       $closeAccount = $this->accountService->closeAccount($data, $accountId);
       return $closeAccount->getResults();
    }

    /**
     * @param string $accountId
     * @return Model
     */
    public function reopenAccount(string $accountId): Model
    {
       $closeAccount = $this->accountService->reopenAccount($accountId);
       return $closeAccount->getResults();
    }

    /**
     * @param array|null $data
     * @param string $accountId
     * @return Model
     */
    public function freezeAccount(?array $data, string $accountId): Model
    {
        $closeAccount = $this->accountService->freezeAccount($data, $accountId);
        return $closeAccount->getResults();
    }

    /**
     * @param string $accountId
     * @return Model
     */
    public function unfreezeAccount(string $accountId): Model
    {
        $closeAccount = $this->accountService->unfreezeAccount($accountId);
        return $closeAccount->getResults();
    }

    /**
     * @param string $accountId
     * @return Model
     */
    public function getById(string $accountId): Model
    {
        $closeAccount = $this->accountService->getById($accountId);
        return $closeAccount->getResults();
    }

    /**
     * @param string $accountId
     * @return Model
     */
    public function limits(string $accountId): Model
    {
        $closeAccount = $this->accountService->limits($accountId);
        return $closeAccount->getResults();
    }
}
