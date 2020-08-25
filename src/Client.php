<?php

namespace Zero\Http;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;

abstract class Client implements ClientInterface
{
    /**
     * User specified recursion depth for json_encode().
     *
     * @var int
     */
    CONST DEPTH = 512;

    /**
     * @var GuzzleClientInterface
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
    public function setHttp(GuzzleClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @inheritDoc
     */
    public function http(): GuzzleClientInterface
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
    public function request(string $method, string $url, array $params = [], array $headers = [], array $options = [])
    {
        if (sizeOf($params) > 0) {
            $contentKey = strtoupper($method) == 'GET' ? RequestOptions::QUERY : RequestOptions::JSON;
            $options = [$contentKey => $params] + $options;
        }

        if (sizeof($headers) > 0) {
            $options = [RequestOptions::HEADERS => $headers] + $options;
        }

        $response = $this->http()->request($method, $url, $options);

        $body = json_decode((string) $response->getBody(), false, static::DEPTH, JSON_THROW_ON_ERROR);

        return $body;
    }

    /**
     * @inheritDoc
     */
    public function get(string $url, array $params = [], array $headers = [], array $options = [])
    {
        return $this->request('GET', $url, $params, $headers, $options);
    }

    /**
     * @inheritDoc
     */
    public function post(string $url, array $params = [], array $headers = [], array $options = [])
    {
        return $this->request('POST', $url, $params, $headers, $options);
    }

    /**
     * @inheritDoc
     */
    public function put(string $url, array $params = [], array $headers = [], array $options = [])
    {
        return $this->request('PUT', $url, $params, $headers, $options);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $url, array $params = [], array $headers = [], array $options = [])
    {
        return $this->request('DELETE', $url, $params, $headers, $options);
    }
}
