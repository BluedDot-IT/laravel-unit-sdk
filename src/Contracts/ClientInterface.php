<?php

namespace BluedotDev\Unit\Contracts;

use BluedotDev\Unit\Classes\Response;
use Illuminate\Database\Eloquent\Model;

interface ClientInterface
{
    public function createToken(int $userId): Model;
    public function getTokenList(int $userId): Model;
    public function getAccounts(): Model|Response;
    public function createAccount(array $data, string $customerId): Model;
    public function closeAccount(array $data, string $accountId);
    public function reopenAccount(string $accountId): Model;
    public function freezeAccount(array $data,string $accountId): Model;
    public function unfreezeAccount(string $accountId): Model;
    public function getAccountById(string $accountId): Model;
    public function limits(string $accountId): Model;

    public function getTransactions():Model|Response;
}
