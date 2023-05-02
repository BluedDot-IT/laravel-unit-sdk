<?php

namespace Bluedot\Unit\Contracts;

interface TransactionServiceInterface
{
    public function getList(): TransactionServiceInterface;
    public function getById(string $accountId,string $transactionId): TransactionServiceInterface;
}
