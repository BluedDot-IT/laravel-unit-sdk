<?php

namespace BluedotDev\Unit\Contracts;

interface TokenServiceInterface
{
    public function createToken(int $userId): self;
    public function getTokenList(int $userId): self;
}
