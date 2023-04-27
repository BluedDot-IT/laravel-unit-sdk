<?php

namespace Bluedot\Unit;

use Bluedot\Unit\Exceptions\MethodNotAllowed;
use Illuminate\Support\Str;

class Requester
{
    private string $url;
    private string $method;
    private array $requestBody;
    private array $headers;

    /**
     * configure requester before request
     *
     * @throws MethodNotAllowed
     */
    public function prepare(...$args): self
    {
        foreach ($args as $key => $value){
            if ( $key == "method" && !in_array($key, config('bluedot-unit.Allowed-methods')) ){
                throw new MethodNotAllowed($value); // only method pass enough for here.
            }

            if ( property_exists($this, $key) ){
                $this->{lcfirst(Str::camel($key))} = $value;
            }
        }
        return $this;
    }

    public function payload(): array
    {
        return [
            "url"           => $this->url,
            "method"        => $this->method,
            "requestBody"   => $this->requestBody,
            "headers"       => $this->headers
        ];
    }

    public function sendRequest(): array
    {
        //.. coming soon!

        return [];
    }
}
