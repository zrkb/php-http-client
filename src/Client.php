<?php

namespace Zero\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface as PsrClientInterface;

abstract class Client implements ClientInterface
{
    /**
     * User specified recursion depth for json_encode().
     *
     * @var int
     */
    CONST DEPTH = 512;

    /**
     * @var PsrClientInterface
     */
    private $http;

    /**
     * @var string
     */
    private $baseUri;

    public function __construct(string $baseUri = null) {
        $this->baseUri = $baseUri;
    }

    /**
     * @inheritDoc
     */
    public function setHttp(PsrClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @inheritDoc
     */
    public function http(): PsrClientInterface
    {
        if ($this->http === null) {
            $this->http = new GuzzleClient(['base_uri' => $this->baseUri()]);
        }

        return $this->http;
    }

    /**
     * @inheritDoc
     */
    public function setBaseUri(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @inheritDoc
     */
    public function baseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @inheritDoc
     */
    public function request(string $method, string $url, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        $request = new Request($method, $url, $headers, $body, $protocolVersion);
        $response = $this->http()->sendRequest($request);

        $body = json_decode((string) $response->getBody(), false, static::DEPTH, JSON_THROW_ON_ERROR);

        return $body;
    }

    /**
     * @inheritDoc
     */
    public function get(string $url, array $headers = [], $body = null)
    {
        return $this->request('GET', $url, $headers, $body);
    }

    /**
     * @inheritDoc
     */
    public function post(string $url, array $headers = [], $body = null)
    {
        return $this->request('POST', $url, $headers, $body);
    }

    /**
     * @inheritDoc
     */
    public function put(string $url, array $headers = [], $body = null)
    {
        return $this->request('PUT', $url, $headers, $body);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $url, array $headers = [], $body = null)
    {
        return $this->request('DELETE', $url, $headers, $body);
    }
}
