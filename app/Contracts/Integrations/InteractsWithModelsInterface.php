<?php

namespace App\Contracts\Integrations;

interface InteractsWithModelsInterface
{
    /**
     * Hydrate a new Entity from a model.
     *
     * @param  mixed  $model
     * @return \App\Contracts\Integrations\EntityInterface
     */
    public static function fromModel($model): EntityInterface;

    /**
     * Convert the entity into a model's dataset.
     *
     * @return array
     */
    public function toModel(): array;
}
