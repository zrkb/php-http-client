<?php

namespace Zero\Http;

use Psr\Http\Client\ClientInterface as PsrClientInterface;

interface ClientInterface
{
    /**
     * Sets the http client.
     *
     * @param PsrClientInterface $http
     */
    public function setHttp(PsrClientInterface $http);

    /**
     * Returns the http client.
     *
     * @return PsrClientInterface
     */
    public function http(): PsrClientInterface;

    /**
     * Set the base uri.
     *
     * @param string $baseUri
     * @return string
     */
    public function setBaseUri(string $baseUri);

    /**
     * Base uri for client.
     *
     * @return string
     */
    public function baseUri(): string;

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
}
