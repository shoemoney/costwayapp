<?php

namespace App\Integrations\Http;

use Illuminate\Contracts\Support\Arrayable;
use GuzzleHttp\Psr7\Response as Psr7Response;

class Response implements Arrayable
{
    /** @var string */
    protected $body = "";

    /** @var int */
    protected $status = 200;

    public function __construct(Psr7Response $psr7Response)
    {
        $this->body = $psr7Response->getBody()
            ->getContents();

        $this->status = $psr7Response->getStatusCode();
    }

    /**
     * Determine if the response indicates success.
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->status < 300;
    }

    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getBody();
    }
}
