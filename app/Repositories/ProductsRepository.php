<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\Integrations\Entities\ProductInterface;

class ProductsRepository
{
    /**
     * Look up a product model by provider and identifier.
     *
     * @param  string  $provider
     * @param  string  $identifier
     * @return \App\Models\Product|null
     */
    public function lookup($provider, $identifier)
    {
        return Product::where('provider', $provider)
            ->where('identifier', $identifier)
            ->first();
    }

    /**
     * Find a product entity's corresponding model.
     *
     * @param  \App\Contracts\Integrations\Entities\ProductInterface  $entity
     * @return \App\Models\Product
     */
    public function findOrCreateEntityProduct(ProductInterface $entity)
    {
        $lookup = $entity->toModel();
        $model = $this->lookup($lookup['provider'], $lookup['identifier']);

        return $model
            ?? $this->createFromEntity($entity);
    }

    /**
     * Create a new product model from an entity.
     *
     * @param  \App\Contracts\Integrations\Entities\ProductInterface  $entity
     * @return \App\Models\Product
     */
    public function createFromEntity(ProductInterface $entity)
    {
        return Product::create(
            $entity->toModel()
        );
    }
}
