<?php

namespace Bluedot\Unit\Contracts;


interface AccountServiceInterface
{
    public function getAccounts(): self;
    public function createAccount(?array $data, string $customerId): self;
    public function closeAccount(?array $data, string $accountId): self;
    public function reopenAccount(string $accountId): self;
    public function freezeAccount(?array $data,string $accountId): self;
    public function unfreezeAccount(string $accountId): self;
}
