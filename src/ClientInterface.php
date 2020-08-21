<?php

namespace Http;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;

interface ClientInterface
{
    /**
     * Sets the http client.
     *
     * @param string $http
     *
     * @return ClientInterface
     */
    public function setHttp(HttpClient $http);

    /**
     * Returns the http client.
     *
     * @return Http\Client\HttpClient
     */
    public function http(): HttpClient;

    /**
     * @param MessageFactory $messageFactory
     *
     * @return \Http\Message\MessageFactory
     */
    public function setMessageFactory(MessageFactory $messageFactory);

    /**
     * Returns the message factory.
     *
     * @return \Http\Message\MessageFactory
     */
    public function messageFactory();

    /**
     * Make an http request.
     *
     * @param string $method
     * @param string|UriInterface $uri
     * @param array $headers
     * @param resource|string|StreamInterface|null $body
     * @param string $protocolVersion
     *
     * @return mixed
     * @throws \Exception
     */
    public function request(string $method, string $url, array $headers = [], $body = null, $protocolVersion = '1.1');

    /**
     * Make a GET request.
     *
     * @param string|UriInterface $uri
     * @param array $headers
     * @param resource|string|StreamInterface|null $body
     *
     * @return mixed
     * @throws \Exception
     */
    public function get(string $url, array $headers = [], $body = null);

    /**
     * Make a POST request.
     *
     * @param string|UriInterface $uri
     * @param array $headers
     * @param resource|string|StreamInterface|null $body
     *
     * @return mixed
     * @throws \Exception
     */
    public function post(string $url, array $headers = [], $body = null);

    /**
     * Make a PUT request.
     *
     * @param string|UriInterface $uri
     * @param array $headers
     * @param resource|string|StreamInterface|null $body
     *
     * @return mixed
     * @throws \Exception
     */
    public function put(string $url, array $headers = [], $body = null);

    /**
     * Make a DELETE request.
     *
     * @param string|UriInterface $uri
     * @param array $headers
     * @param resource|string|StreamInterface|null $body
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete(string $url, array $headers = [], $body = null);

    /**
     * Base uri for client.
     *
     * @return string
     */
    public function baseUri();
}
