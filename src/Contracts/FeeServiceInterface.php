<?php

namespace BluedotDev\Unit\Contracts;

interface FeeServiceInterface
{
    public function createFee(int $amount, string $description, string $accountId, ?string $idempotencyKey = null): FeeServiceInterface;
    public function reverseFee(int $amount, string $description, string $accountId, string $transactionId): FeeServiceInterface;
}
