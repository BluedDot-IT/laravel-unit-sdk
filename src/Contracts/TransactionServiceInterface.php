<?php

namespace BluedotDev\Unit\Contracts;

interface TransactionServiceInterface
{
    public function getList(array $filters): TransactionServiceInterface;
    public function getById(string $accountId,string $transactionId): TransactionServiceInterface;
}
