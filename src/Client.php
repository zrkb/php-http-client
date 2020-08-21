<?php

namespace Http;

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle\Client as GuzzleAdapter;
use Http\ClientInterface;
use Http\Client\HttpClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\MessageFactory;

abstract class Client implements ClientInterface
{
    /**
     * ######################################################
     */

    /**
     * @var \Http\Client\HttpClient
     */
    private $http;

    /**
     * @var \Http\Message\MessageFactory
     */
    private $requestFactory;

    /**
     * @inheritDoc
     */
    public function setHttp(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @inheritDoc
     */
    public function http(): HttpClient
    {
        if ($this->http === null) {
            $guzzle = new GuzzleClient(['base_uri' => $this->baseUri()]);
            $adapter = new GuzzleAdapter($guzzle);

            $this->http = $adapter;
        }

        return $this->http;
    }

    /**
     * @inheritDoc
     */
    public function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function messageFactory()
    {
        if ($this->messageFactory === null) {
            $this->messageFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        return $this->messageFactory;
    }

    /**
     * @inheritDoc
     */
    public function request(string $method, string $url, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        $request = $this->messageFactory()->createRequest($method, $url, $headers, $body, $protocolVersion);

        return $this->http()->sendRequest($request);
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

    /**
     * @inheritDoc
     */
    abstract public function baseUri();
}
