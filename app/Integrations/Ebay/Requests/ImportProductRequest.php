<?php

namespace App\Integrations\Ebay\Requests;

use App\Integrations\Ebay\Ebay;
use App\Integrations\Http\Request;
use App\Integrations\Ebay\Entities\Product;
use App\Integrations\Ebay\Entities\VariationProduct;
use App\Integrations\Ebay\Responses\ImportProductResponse;

class ImportProductRequest extends Request
{
    /** @var string */
    protected $endpoint = "";

    /** @var string */
    protected $responseHandler = ImportProductResponse::class;

    /**
     * Export the product into Ebay
     * @return
     */
    public function export($model)
    {
        return (new Product)
            ->fillFromModel($model)
            ->export();
    }

    /**
     * Export the variation product into Ebay
     * @return
     */
    public function exportVariation()
    {
        return (new VariationProduct)
            ->fillFromModel()
            ->import();
    }

}
