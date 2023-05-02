# laravel-unit-sdk

## Installation

**Require package**
```composer
composer require bluedot/laravel-unit-sdk
```

**Publish vendor**
```composer
php artisan vendor:publish --tag=bluedot-unit
```
> PS : 


-----------------------
#### REQUEST
```php
use Bluedot\Unit\Facades\Unit;

$results = Unit::getTokenList();
```

#### RESPONSE
```php
use Bluedot\Unit\Facades\Unit;

// AS MODEL :
$result = Unit::getAccountById($accountId);

// AS ARRAY
$resultAsArray = Unit::getAccountById()->toArray();
                    
// STATUS CODE
$statusCode = Unit::getTokenList()->getStatusCode();
```

#### WORKING WITH LIST
```php
use Bluedot\Unit\Facades\Unit;
$responseClass = Unit::getTransactions(); // returns Response

foreach ($responseClass->result as $transaction) {
    dd($transaction);
}
```
#### WORKING WITH MODEL
```php
use Bluedot\Unit\Facades\Unit;

$transaction = Unit::getTransactionById($accountId, $transaction);
$transactionId = $transaction->id;
```

### AVAILABLE METHODS

#### Accounts
```php
use Bluedot\Unit\Facades\Unit;

Unit::getAccounts();
Unit::createAccount(?array $data, string $customerId);
Unit::closeAccount(?array $data, string $accountId);
Unit::reopenAccount(int $accountId);
Unit::freezeAccount(?array $data, string $accountId);
Unit::unfreezeAccount(string $accountId);
Unit::getAccountById(string $accountId);
Unit::limits(string $accountId);
```

#### Transactions
```php
use Bluedot\Unit\Facades\Unit;

Unit::getTransactions();
Unit::getTransactionById(string $accountId, string $accountId);
```
