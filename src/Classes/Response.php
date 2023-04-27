<?php

namespace Bluedot\Unit\Classes;

class Response
{
    public int $statusCode;
    public string $message;
    public array $responseBody;
    public array $result;


    public function parse()
    {
        // will implement
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
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Response
     */
    public function setMessage(string $message): Response
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getResponseBody(): array
    {
        return $this->responseBody;
    }

    /**
     * @param array $responseBody
     * @return Response
     */
    public function setResponseBody(array $responseBody): Response
    {
        $this->responseBody = $responseBody;
        return $this;
    }



}
