<?php

namespace App\Integrations\Ebay\Entities;

use App\Contracts\Integrations\EntityInterface;
use App\Contracts\Integrations\InteractsWithModelsInterface;

class Sale extends Entity implements InteractsWithModelsInterface
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'provider' => 'ebay',
            'product_id' => $this->data['product_id'],
            'price' => floatval(round($this->data['price'], 2)),
            'quantity' => intval($this->data['quantity']),
            'sold_at' => $this->data['sold_at'],
        ];
    }

    /**
     * Hydrate a new Entity from a model.
     *
     * @param  mixed  $model
     * @return \App\Contracts\Integrations\EntityInterface
     */
    public static function fromModel($model): EntityInterface
    {
        return new static([]);
    }

    /**
     * Convert the entity into a model's dataset.
     *
     * @return array
     */
    public function toModel(): array
    {
        return [
            'provider' => 'ebay',
            'product_id' => $this->data['product_id'],
            'price' => floatval(round($this->data['price'], 2)),
            'quantity' => intval($this->data['quantity']),
            'sold_at' => $this->data['sold_at'],
        ];
    }
}
