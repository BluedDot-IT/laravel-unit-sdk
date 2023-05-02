<?php

namespace BluedotDev\Unit\Classes;

use BluedotDev\Unit\Models\Account;
use BluedotDev\Unit\Models\Transaction;
use Psr\Http\Message\ResponseInterface;

class Response
{
    public int $statusCode;
    public string $responseBody;
    public array $result;
    public string $requestType;

    private array $modelMap = [
        'accountLimit' => Account::class,
        'accountLists' => Account::class,
        'accountOption' => Account::class,

        'transactionLists' => Transaction::class,
        'getTransaction' => Transaction::class,
    ];


    public function parse(ResponseInterface $result, string $type): self
    {
        $this->requestType = $type;
        $this->result = json_decode($result->getBody()->getContents(), true);
        $this->responseBody = $result->getBody()->getContents();
        $this->statusCode = $result->getStatusCode();

        return $this;
    }

    public function toArray(): array
    {
        return $this->result;
    }
    public function toModel(): mixed
    {
        if (!isset($this->modelMap[$this->requestType])) {
            throw new \InvalidArgumentException("Model mapping for '{$this->requestType}' not found.");
        }

        $modelClass = $this->modelMap[$this->requestType];

        $methodName = lcfirst($this->requestType);

        if (method_exists($modelClass, $methodName)) {
            if (isset($this->result['data']) && is_array($this->result['data']) && str_ends_with($methodName, 's')) {
                $modelList = [];
                foreach ($this->result['data'] as $item) {
                    $modelList[] = $modelClass::$methodName($item);
                }
                $this->result = $modelList;
                return $this;
            } else {
                return $modelClass::$methodName($this->result);
            }
        } else {
            throw new \BadMethodCallException("Method '{$methodName}' not found in '{$modelClass}'.");
        }
    }


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseBody(): string
    {
        return $this->responseBody;
    }

    /**
     * @param string $responseBody
     * @return Response
     */
    public function setResponseBody(string $responseBody): Response
    {
        $this->responseBody = $responseBody;
        return $this;
    }



}
