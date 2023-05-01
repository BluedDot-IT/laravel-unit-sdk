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
 * @method static createToken(int $userId):Response
 * @method static getTokenList(int $userId):Response
 * @method static getAccounts():Response
 * @method static createAccount(?array $data, int $customerId): Response
 * @method static closeAccount(?array $data, int $accountId): Response
 * @method static reopenAccount(int $accountId): Response
 * @method static freezeAccount(?array $data, int $accountId): Response
 * @method static unfreezeAccount(int $accountId): Response
```
