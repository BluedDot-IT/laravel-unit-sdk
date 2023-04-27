# laravel-unit-sdk


```php

$client = new \Bluedot\Unit\Client();
```

> REQUEST
```php
$client->get("/", []);
$payload = $client->getRequester()->payload()
```

> RESPONSE
```php
$result = $client->getResponse()->result;
$responseBody = $client->getResponse()->responseBody;
```
