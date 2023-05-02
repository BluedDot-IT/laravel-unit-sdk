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
use BluedotDev\Unit\Facades\Unit;

Unit::getTransactions();
Unit::getTransactionById(string $accountId, string $accountId);
```
