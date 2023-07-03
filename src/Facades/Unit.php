<?php

namespace BluedotDev\Unit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @author Taner Tombas <taner@thebluedot.co>
 * @version 1.0.6
 *
 * @method static createToken(int $userId):Response
 * @method static getTokenList(int $userId):Response
 * @method static getAccounts():Response|Model
 * @method static createAccount(?array $data, int $customerId): Model
 * @method static closeAccount(?array $data, int $accountId): Model
 * @method static reopenAccount(int $accountId): Model
 * @method static freezeAccount(?array $data, int $accountId): Model
 * @method static unfreezeAccount(int $accountId): Model
 * @method static getAccountById(int $accountId): Model
 * @method static limits(int $accountId): Model
 * @method static getTransactions(...$filters):Response|model
 * @method static getTransactionById(string $accountId, string $transactionId):Response|model
 * @method static createReward(array $data, string $fundingAccountId = null):Model
 * @method static createFee(array $data): Model
 */
class Unit extends Facade {
    protected static function getFacadeAccessor(): string
    {
        return 'BluedotDevUnitClient';
    }
}
