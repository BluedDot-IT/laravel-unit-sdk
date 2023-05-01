<?php

namespace Bluedot\Unit\Contracts;


interface AccountServiceInterface
{
    public function getAccounts(): AccountServiceInterface;
    public function createAccount(?array $data, string $customerId): AccountServiceInterface;
    public function closeAccount(?array $data, string $accountId): AccountServiceInterface;
    public function reopenAccount(string $accountId): AccountServiceInterface;
    public function freezeAccount(?array $data,string $accountId): AccountServiceInterface;
    public function unfreezeAccount(string $accountId): AccountServiceInterface;
    public function getById(string $accountId): AccountServiceInterface;
    public function limits(string $accountId);
}
