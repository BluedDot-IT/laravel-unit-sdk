<?php

namespace BluedotDev\Unit\Classes;

use BluedotDev\Unit\Exceptions\MethodNotAllowed;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

class Requester
{
    private string $url;
    private string $method;
    private ?array $requestBody;
    private array $headers;

    protected Client $client;

    public function __construct()
    {
        $this->headers = [
            "content-type" => config("bluedot-unit.api.content-type"),
            "Authorization" => "Bearer " . config("bluedot-unit.api.auth-token")
        ];

    }

    /**
     * configure requester before request
     *
     * @throws MethodNotAllowed
     */
    public function prepare(...$args): self
    {
        foreach ($args as $key => $value){
            if ( $key == "method" && !in_array($value, config('bluedot-unit.Allowed-methods')) ){
                throw new MethodNotAllowed($value);
            }

            if ( property_exists($this, $key) ){
                $this->{lcfirst(Str::camel($key))} = $value;
            }
        }

        $this->client = new Client([
            "base_uri" => config('bluedot-unit.api.base_uri'),
            "timeout" => 5.0
        ]);

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

    /**
     * @throws GuzzleException
     */
    public function sendRequest(): ResponseInterface
    {
        $body = [
            "headers" => $this->headers
        ];

        if (isset($this->requestBody)) {
            $body['json'] = $this->requestBody;
        }

        try {
            return $this->client->request($this->method, $this->url, $body);
        }catch (GuzzleException $exception){
            Log::error("API Request failed. Error details: " . $exception->getMessage());
            throw $exception;
        }
    }
}
