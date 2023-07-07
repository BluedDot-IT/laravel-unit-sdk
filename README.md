## Installation

------------------
**Require package**
```composer
composer require bluedot-dev/laravel-unit-sdk
```

**Publish vendor**
```composer
php artisan vendor:publish --tag=bluedot-unit
```

## Usage

----------------------

#### BASIC
```php
use BluedotDev\Unit\Facades\Unit;

$results = Unit::getTransactions();
```

#### DATA TYPES
```php
use BluedotDev\Unit\Facades\Unit;

// GET DATA AS MODEL
$result = Unit::getAccountById($accountId);

// GET DATA AS ARRAY
$resultAsArray = Unit::getAccountById()->toArray();

// GET DATA AS MODEL STACK IN RESPONSE CLASS
$response = Unit::getTransactions();
                    
// GET RESULT STATUS CODE
$statusCode = Unit::getTokenList()->getStatusCode();
```

#### WORKING WITH LIST
```php
use BluedotDev\Unit\Facades\Unit;
$responseClass = Unit::getTransactions(); // returns Response

foreach ($responseClass->result as $transaction) {
    dd($transaction);
}
```
#### WORKING WITH MODEL
```php
use BluedotDev\Unit\Facades\Unit;

$transaction = Unit::getTransactionById($accountId, $transaction);
$transactionId = $transaction->id;
```

### AVAILABLE METHODS

#### Accounts
```php
use BluedotDev\Unit\Facades\Unit;

 Unit::createToken(int $userId):Response
 Unit::getTokenList(int $userId):Response
 Unit::getAccounts():Response|Model
 Unit::createAccount(?array $data, int $customerId): Model
 Unit::closeAccount(?array $data, int $accountId): Model
 Unit::reopenAccount(int $accountId): Model
 Unit::freezeAccount(?array $data, int $accountId): Model
 Unit::unfreezeAccount(int $accountId): Model
 Unit::getAccountById(int $accountId): Model
 Unit::limits(int $accountId): Model
 Unit::getTransactions(...$filters):Response|model
 Unit::getTransactionById(string $accountId, string $transactionId):Response|model
 Unit::createReward(array $data, string $fundingAccountId = null):Model
 Unit::createFee(array $data): Model
```

#### Transactions
```php
use BluedotDev\Unit\Facades\Unit;

Unit::getTransactions();
Unit::getTransactionById(string $accountId, string $accountId);
```
