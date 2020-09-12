<?php

namespace App\Integrations\Http;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Integrations\Http\Client;
use App\Integrations\Http\Response;
use App\Events\Integrations\RequestMade;
use GuzzleHttp\Psr7\Response as Psr7Response;

abstract class Request
{
    /** @var string */
    protected $endpoint = "";

    /** @var string */
    protected $method = "GET";

    /** @var array */
    protected $options = [];

    /** @var array */
    protected $data = [];

    /** @var string */
    protected $responseHandler = Response::class;

    /** @var int */
    protected $sentAt;

    /**
     * Handle the sending of the HTTP Request.
     *
     * @return \App\Integrations\Http\Response
     */
    public function handle()
    {
        $client = app(Client::class);
        $this->sentAt = microtime(true);

        $response = $this->createResponse(
            $client->send(
                $this->attachData()
            )
        );

        return tap($response, function ($response) {
            event(new RequestMade($this, $response));
        });
    }

    /**
     * Get the endpoint attribute.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Get the method atrribute.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return Str::upper($this->method);
    }

    /**
     * Get the options attribute.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Add a key and value to the options attribute.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return \App\Integrations\Http\Request|$this
     */
    public function addOption($key, $value): self
    {
        Arr::set($this->options, $key, $value);

        return $this;
    }

    /**
     * Set the endpoint attribute.
     *
     * @param  string  $uri
     * @return \App\Integrations\Http\Request|$this
     */
    public function setEndpoint(string $uri): self
    {
        $this->endpoint = $uri;

        return $this;
    }

    /**
     * Append to the endpoint attribute.
     *
     * @param  string  $append
     * @return \App\Integrations\Http\Request|$this
     */
    public function appendToEndpoint(string $append): self
    {
        return $this->setEndpoint(
            $this->endpoint . $append
        );
    }

    /**
     * Set the method attribute.
     *
     * @param  string  $method
     * @return \App\Integrations\Http\Request|$this
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Perform a GET request.
     *
     * @return \App\Integrations\Http\Response
     */
    public function get()
    {
        return $this->setMethod("GET")
            ->handle();
    }

    /**
     * Perform a POST request.
     *
     * @return \App\Integrations\Http\Response
     */
    public function post()
    {
        return $this->setMethod("POST")
            ->handle();
    }

    /**
     * Add a key and value to the data array.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return \App\Integrations\Http\Request|$this
     */
    public function addData($key, $value): self
    {
        Arr::set($this->data, $key, $value);

        return $this;
    }

    /**
     * Set the value of the data attribute.
     *
     * @param  array  $data
     * @return \App\Integrations\Http\Request|$this
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Attach the data attribute to the request.
     *
     * @return \App\Integrations\Http\Request|$this
     */
    protected function attachData(): Request
    {
        switch ($this->getMethod()) {
            case "GET":
                $data = http_build_query($this->data);
                $this->appendToEndpoint("?{$data}");
                break;
            case "POST":
                $this->addOption('data', $this->data);
                break;
            default:
                break;
        }

        return $this;
    }

    /**
     * Create a new instance of the response for this request.
     *
     * @param  \GuzzleHttp\Psr7\Response  $psr7Response
     * @return \App\Integrations\Http\Response
     */
    protected function createResponse(Psr7Response $psr7Response): Response
    {
        return app($this->responseHandler, ['psr7Response' => $psr7Response]);
    }

    /**
     * Calculate the time difference (in ms) since this request was sent.
     *
     * @return int
     */
    public function duration()
    {
        return microtime(true) - $this->sentAt;
    }
}
