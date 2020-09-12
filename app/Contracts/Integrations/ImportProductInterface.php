<?php

namespace App\Contracts\Integrations;

interface ImportProductInterface
{
    /**
     * Fill a products attribute
     *
     * @param array $product
     * @return
     */

    public function product(array $product);
}
