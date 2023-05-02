<?php

namespace BluedotDev\Unit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @author Taner Tombas <taner@thebluedot.co>
 * @version 1.1
 *
 * @method static createToken(int $userId):Response
 * @method static getTokenList(int $userId):Response
 * @method static getAccounts():Response
 * @method static createAccount(?array $data, int $customerId): Response
 * @method static closeAccount(?array $data, int $accountId): Response
 * @method static reopenAccount(int $accountId): Response
 * @method static freezeAccount(?array $data, int $accountId): Response
 * @method static unfreezeAccount(int $accountId): Response
 * @method static getAccountById(int $accountId): Response
 * @method static limits(int $accountId): Response
 * @method static getTransactions():Response|model
 * @method static getTransactionById(string $accountId, string $transactionId):Response|model
 */
class Unit extends Facade {
    protected static function getFacadeAccessor(): string
    {
        return 'BluedotDevUnitClient';
    }
}
