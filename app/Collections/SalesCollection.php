<?php

namespace App\Collections;

use Illuminate\Support\Collection;

class SalesCollection extends Collection
{
    /**
     * Convert all Sale Entities to their model format.
     *
     * @return array
     */
    public function toModels()
    {
        return $this
            ->map->toModel();
    }
}
