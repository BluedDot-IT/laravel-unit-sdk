<?php

namespace Bluedot\Unit\Contracts;

use Bluedot\Unit\Classes\Response;

interface TokenServiceInterface
{
    public function createToken(int $userId): self;
    public function getTokenList(int $userId): self;
    public function getResults(): Response;
}
