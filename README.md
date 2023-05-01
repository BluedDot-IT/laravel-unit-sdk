# laravel-unit-sdk



> REQUEST
```php
use Bluedot\Unit\Facades\Unit;

$results = Unit::getTokenList();
```

> RESPONSE
```php
// AS OBJECT :
$result = Unit::getTokenList();

// AS ARRAY
$resultAsArray = Unit::getTokenList()->toArray();
                    
// STATUS CODE
$statusCode = Unit::getTokenList()->getStatusCode();
```


### METHODS

```php
use Bluedot\Unit\Facades\Unit;

#Token
Unit::createToken(int $userId)
Unit::getTokenList(int $userId)

# Accounts
Unit::getAccounts()
Unit::createAccount(?array $data, int $customerId)
Unit::closeAccount(?array $data, int $accountId)
Unit::reopenAccount(int $accountId)
Unit::freezeAccount(?array $data, int $accountId)
Unit::unfreezeAccount(int $accountId)
Unit::getById(int $accountId)
Unit::limits(int $accountId)
```
