<?php

namespace App\Scraping;

use GuzzleHttp\Client;
use App\Contracts\Scraping\ClientInterface;

class HttpClient implements ClientInterface
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var array */
    protected $options = [];

    /** @var string */
    protected $method = "GET";

    /** @var string */
    protected $uri = "";

    /**
     * @param  \GuzzleHttp\Client  $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the request.
     *
     * @var  array  $options
     * @return string
     */
    public function handle($options = []): string
    {
        $response = $this->client->request(
            $this->method = $this->guessMethod($options),
            $this->uri = $this->extractUri($options),
            $this->options = $this->extractOptions($options)
        );

        return $response->getBody()
            ->getContents();
    }

    /**
     * Guess the HTTP method to use in the request.
     *
     * @var  array  $options
     * @return string
     */
    protected function guessMethod(array $options): string
    {
        return strtoupper($options['method'] ?? $this->method);
    }

    /**
     * Retrieve the URI from the options.
     *
     * @param  array $options
     * @return string
     */
    protected function extractUri(array $options): string
    {
        $uri = $options['uri'] ?? false;

        if (!$uri) {
            throw new \Exception("No URI provided.");
        }

        return $uri;
    }

    /**
     * Extract the remaining options given to the request.
     *
     * @param  array  $options
     * @return array
     */
    protected function extractOptions(array $options): array
    {
        return array_merge(
            $options,
            $this->getDefaultOptions()
        );
    }

    /**
     * Get the default options for the client.
     *
     * @return array
     */
    protected function getDefaultOptions()
    {
        return config('scraping.clients.http.options', []);
    }

    /**
     * Make a GET request to the given URI.
     *
     * @param  string  $uri
     * @param  array  $options
     * @return string
     */
    public function get(string $uri, array $options = []): string
    {
        return $this->handle(
            array_merge(
                [
                    'method' => 'GET',
                    'uri' => $uri,
                ],
                $options
            )
        );
    }
}
