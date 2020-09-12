<?php

namespace App\Integrations\Ebay;

use App\Contracts\Integrations\ImportProductInterface;
use App\Integrations\Ebay\Import\ImportProduct;
use App\Integrations\Ebay\Provider;

class ImportProvider extends Provider implements ImportProductInterface
{
    /**
     * Import a simple product
     *
     * @param array $product
     * @return
     */

    public function product(array $product)
    {
        return (new ImportProduct())->ImportSimpleProduct($product);
    }
}
