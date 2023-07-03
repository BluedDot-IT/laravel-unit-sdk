<?php

namespace BluedotDev\Unit\Contracts;

interface RewardServiceInterface
{
    public function createReward(array $data, string $fundingAccountId = null ): RewardServiceInterface;
}
