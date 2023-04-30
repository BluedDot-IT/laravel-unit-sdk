<?php

namespace Bluedot\Unit\Classes;

use Psr\Http\Message\ResponseInterface;

class Response
{
    public int $statusCode;
    public string $responseBody;
    public array $result;


    public function parse(ResponseInterface $result): self
    {
        $this->result = json_decode($result->getBody()->getContents(), true);
        $this->responseBody = $result->getBody()->getContents();
        $this->statusCode = $result->getStatusCode();

        return $this;
    }

    public function toArray(): array
    {
        return $this->result;
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
