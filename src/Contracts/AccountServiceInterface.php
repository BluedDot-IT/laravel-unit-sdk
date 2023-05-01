<?php

namespace Bluedot\Unit\Contracts;

use Bluedot\Unit\Classes\Response;

interface AccountServiceInterface
{
    public function getAccounts();

    public function createAccount(array $data, string $customerId);
}
