<?php

namespace Bluedot\Unit\Contracts;

use Bluedot\Unit\Classes\Response;

interface ClientInterface
{
    public function createToken(int $userId): Response;
    public function getTokenList(int $userId): Response;
    public function getAccounts(): Response;
    public function createAccount(array $data, string $customerId): Response;
}
