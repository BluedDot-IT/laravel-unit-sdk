<?php
namespace Bluedot\Unit;

use Bluedot\Unit\Abstracts\Client as ClientAbstract;
use Bluedot\Unit\Contracts\ClientInterface;
use Bluedot\Unit\Exceptions\MethodNotAllowed;
use Illuminate\Http\Request;

class Client extends ClientAbstract implements ClientInterface
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string|null $url
     * @param array|null $headers
     * @return ClientAbstract
     *
     * @throws MethodNotAllowed
     */
    public function get(?string $url, ?array $headers): self
    {
        $this->setHeaders([
            "content-type" => "application/vnd.api+json"
        ]);

        if ( !is_null($headers) ) {
            $this->setHeaders(array_merge($this->getHeaders(), $headers));
        }

        $this->getRequester()->prepare(
            method: Request::METHOD_GET,
            url: config('bluedot-unit.base-url')."/".$url,
            headers: $headers
        );

        $result = $this->getRequester()->sendRequest();
        $this->getResponse()
            ->setResponseBody($result)
            ->parse();

        return $this;
    }

    public function post(?string $url, ?array $requestBody, ?array $headers): self
    {
        // will implement

        return $this;
    }
}
