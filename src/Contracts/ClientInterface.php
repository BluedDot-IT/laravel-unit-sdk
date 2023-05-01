<?php

namespace Bluedot\Unit\Contracts;

use Bluedot\Unit\Classes\Response;

interface ClientInterface
{
    public function createToken(int $userId): Response;
    public function getTokenList(int $userId): Response;
    public function getAccounts(): Response;
    public function createAccount(array $data, string $customerId): Response;
    public function closeAccount(array $data, string $accountId);
    public function reopenAccount(string $accountId): Response;
    public function freezeAccount(array $data,string $accountId): Response;
    public function unfreezeAccount(string $accountId): Response;
}
