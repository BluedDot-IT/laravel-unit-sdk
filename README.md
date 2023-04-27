# laravel-unit-sdk


```php

$client = new \Bluedot\Unit\Client();
$client->get("/", []);

$result = $client->getResponse()->result;
$responseBody = $client->getResponse()->responseBody;
$payload = $client->getRequester()->payload()

```
