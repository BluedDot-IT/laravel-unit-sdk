<?php

namespace BluedotDev\Unit;

use BluedotDev\Unit\Classes\Response;
use BluedotDev\Unit\Contracts\AccountServiceInterface;
use BluedotDev\Unit\Contracts\ClientInterface;
use BluedotDev\Unit\Contracts\FeeServiceInterface;
use BluedotDev\Unit\Contracts\RewardServiceInterface;
use BluedotDev\Unit\Contracts\TokenServiceInterface;
use BluedotDev\Unit\Contracts\TransactionServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @TODO :: need here exception handling mechanism
 * */
class Client implements ClientInterface
{
    private TokenServiceInterface $tokenService;
    private AccountServiceInterface $accountService;
    private TransactionServiceInterface $transactionService;
    private RewardServiceInterface $rewardService;
    private FeeServiceInterface $feeService;

    public function __construct(
        TokenServiceInterface       $tokenService,
        AccountServiceInterface     $accountService,
        TransactionServiceInterface $transactionService,
        RewardServiceInterface      $rewardService,
        FeeServiceInterface         $feeService
    )
    {
        $this->tokenService = $tokenService;
        $this->accountService = $accountService;
        $this->transactionService = $transactionService;
        $this->rewardService = $rewardService;
        $this->feeService = $feeService;
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
    public function getAccountById(string $accountId): Model
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

    /**
     * @param mixed ...$filters
     * @return Model|Response
     */
    public function getTransactions(...$filters): Model|Response
    {
        $transactionList = $this->transactionService->getList($filters);
        return $transactionList->getResults();
    }

    /**
     * @param string $accountId
     * @param string $transactionId
     * @return Model|Response
     */
    public function getTransactionById(string $accountId, string $transactionId): Model|Response
    {
        $transactionList = $this->transactionService->getById($accountId, $transactionId);
        return $transactionList->getResults();
    }

    public function createReward(array $data, string $fundingAccountId = null): Model
    {
        $reward = $this->rewardService->createReward($data, $fundingAccountId);
        return $reward->getResults();
    }


    public function createFee(array $data): Model
    {
        $feeService = $this->feeService->createFee(
            amount: $data['amount'],
            description: $data['description'],
            accountId: $data["accountId"],
            idempotencyKey: $data["idempotencyKey"] ?? null
        );
        return $feeService->getResults();
    }

    public function reverseFee(array $data): Model
    {
        $feeService = $this->feeService->reverseFee(
            amount: $data['amount'],
            description: $data['description'],
            accountId: $data["accountId"],
            transactionId: $data["transactionId"]
        );
        return $feeService->getResults();
    }
}
