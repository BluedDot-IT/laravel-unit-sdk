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
