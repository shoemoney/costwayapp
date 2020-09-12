<?php

namespace App\Contracts\Integrations;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Integrations\EntityInterface;

interface EntityInterface
{
    /**
     * Hydrate a new Entity from the raw API response.
     *
     * @param  array  $response
     * @return \App\Contracts\Integrations\EntityInterface
     */
    public static function fromResponse(array $response): EntityInterface;

    /**
     * Hydrate a new Entity from a model.
     *
     * @param  mixed  $model
     * @return \App\Contracts\Integrations\EntityInterface
     */
    public static function fromModel($model): EntityInterface;
}
