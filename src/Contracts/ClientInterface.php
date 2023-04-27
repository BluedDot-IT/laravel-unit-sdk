<?php

namespace Bluedot\Unit\Contracts;

use Bluedot\Unit\Classes\Response;
use Bluedot\Unit\Requester;

interface ClientInterface
{
    public function get(?string $url, ?array $headers): self;
    public function post(?string $url, ?array $requestBody, ?array $headers): self;
    public function getResponse(): Response;
    public function getRequester(): Requester;
}
