<?php

namespace App\Integrations\Ebay\Entities;

use App\Contracts\Integrations\EntityInterface;
use App\Integrations\Ebay\Ebay;
use App\Integrations\Ebay\ImportProvider;

class VariationProduct extends Entity implements EntityInterface
{

    public function __construct()
    {
    }

    /**
     * Fill a products attribute from the model (when it exists :p)
     *
     * @return
     */

    public function fillFromModel()
    {
        $this->setData([
            'title' => 'Variation product',
            'description' => 'Product Description',
            'price' => 10.0,
            'asin' => '123',
            'category' => '15687',
            'listType' => [
                [
                    'Name' => 'Brand',
                    'Value' => 'Handmade',
                ],
                [
                    'Name' => 'Colour',
                    'Value' => 'Pink',
                ],
            ],
            'variationType' => [
                [
                    'SKU' => 'LI-W-S',
                    'Quantity' => 5,
                    'StartPrice' => 10.99,
                    'ListType' => [
                        [
                            'Name' => 'Color',
                            'Value' => ['White'],
                        ],
                        [
                            'Name' => 'Size (Men\'s)',
                            'Value' => ['S'],
                        ],
                    ],
                ],
                [
                    'SKU' => 'LI-W-M',
                    'Quantity' => 5,
                    'StartPrice' => 10.99,
                    'ListType' => [
                        [
                            'Name' => 'Color',
                            'Value' => ['White'],
                        ],
                        [
                            'Name' => 'Size (Men\'s)',
                            'Value' => ['S'],
                        ],
                    ],
                ],
            ],
            'nameValueList' => [
                'itemSpecifics' => [
                    'Name' => 'Style',
                    'Value' => 'Basic Tee',
                ],
                'Value' => ['Basic Tee'],
                [
                    'Name' => 'Size Type',
                    'Value' => 'Regular',
                ],
                [
                    'Name' => 'Material',
                    'Value' => '100% Cotton',
                ],
            ],
            'pictureType' => [
                [
                    'Value' => 'Red',
                    'PictureUrl' => [
                        'http://lorempixel.com/1500/1024/fashio',
                        'http://lorempixel.com/1500/1024/abstract',
                    ],
                ],
                [
                    'Value' => 'White',
                    'PictureUrl' => [
                        'http://lorempixel.com/1500/1024/cat',
                        'http://lorempixel.com/1500/1024/animals',
                    ],
                ],
                [
                    'Value' => 'Blue',
                    'PictureUrl' => [
                        'http://lorempixel.com/1500/1024/city',
                        'http://lorempixel.com/1500/1024/transport',
                    ],
                ],
            ],
            'address' => [
                'country' => 'GB',
                'location' => 'Barry',
                'postCode' => 'CF63 1EU',
                'currency' => 'GBP',
            ],
        ]);
        return $this;
    }

    /**
     *  Import a simple product
     *  @return
     */
    public function import()
    {
        return app(ImportProvider::class, ['provider' => new Ebay()])
            ->variationProduct($this->getData());
    }

}
