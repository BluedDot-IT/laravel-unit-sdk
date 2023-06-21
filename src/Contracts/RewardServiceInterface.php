<?php

namespace BluedotDev\Unit\Contracts;

interface RewardServiceInterface
{
    public const PROCESS_TYPE_IS_DEPOSIT = "depositAccount";
    public const PROCESS_TYPE_IS_FUNDING = "fundingAccount";

    public function createReward(array $data, string $accountType ): RewardServiceInterface;
}
