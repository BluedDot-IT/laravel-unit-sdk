<?php

namespace Bluedot\Unit\Contracts;

use Bluedot\Unit\Classes\Response;

interface ClientInterface
{
    public function get(): self;
    public function getResponse(): Response;
}
