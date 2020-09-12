<?php

namespace App\Integrations\Ebay\Entities;

use ArrayAccess;
use Illuminate\Support\Arr;
use App\Integrations\Ebay\Ebay;
use Illuminate\Contracts\Support\Arrayable;
use App\Contracts\Integrations\EntityInterface;

abstract class Entity implements Arrayable, EntityInterface, ArrayAccess
{
    /** Will contain data for an Entity */
    protected $data = [];

    /**
     * Create a new instance of the Entity.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * Hydrate a new Entity from the raw API response.
     *
     * @param  array  $response
     * @return \App\Contracts\Integrations\EntityInterface
     */
    public static function fromResponse(array $response): EntityInterface
    {
        return new static($response);
    }

    /**
     * Set the Entity data attribute.
     *
     * @param  array  $data
     * @return \App\Integrations\Ebay\Entities\Entity|$this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set the key within the data attribute.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return \App\Integrations\Ebay\Entities\Entity|$this
     */
    public function set($key, $value)
    {
        Arr::set($this->data, $key, $value);
        return $this;
    }

    /**
     * Get the key from the data attribute.
     *
     * @param  mixed  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->data, $key) ?? $default;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    public function offsetExists($offset): bool
    {
        return Arr::has($this->data, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        Arr::forget($this->data, $offset);
    }
}
