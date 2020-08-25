<?php

namespace Zero\Http;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;

interface ClientInterface
{
    /**
     * Sets the http client.
     *
     * @param GuzzleClientInterface $http
     */
    public function setHttp(GuzzleClientInterface $http);

    /**
     * Returns the http client.
     *
     * @return GuzzleClientInterface
     */
    public function http(): GuzzleClientInterface;

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
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @throws \Exception
     */
    public function request(
        string $method,
        string $url,
        array $params = [],
        array $headers = [],
        array $options = []
    );

    /**
     * Make a GET request.
     *
     * @param string|UriInterface $uri
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @throws \Exception
     */
    public function get(string $url, array $params = [], array $headers = [], array $options = []);

    /**
     * Make a POST request.
     *
     * @param string|UriInterface $uri
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @throws \Exception
     */
    public function post(string $url, array $params = [], array $headers = [], array $options = []);

    /**
     * Make a PUT request.
     *
     * @param string|UriInterface $uri
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @throws \Exception
     */
    public function put(string $url, array $params = [], array $headers = [], array $options = []);

    /**
     * Make a DELETE request.
     *
     * @param string|UriInterface $uri
     * @param array $params
     * @param array $headers
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete(string $url, array $params = [], array $headers = [], array $options = []);
}
