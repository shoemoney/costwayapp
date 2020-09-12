<?php

namespace App\Integrations\Ebay\Entities;

use App\Concerns\Integrations\HasMetrics;
use App\Contracts\Integrations\Entities\ProductInterface;
use App\Contracts\Integrations\EntityInterface;
use App\Contracts\Integrations\InteractsWithModelsInterface;
use App\Integrations\Ebay\Entities\Entity;

class Product extends Entity implements InteractsWithModelsInterface, ProductInterface
{
    use HasMetrics;

    /** @var string */
    public const PRIMARY_KEY = "itemId";

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
            'identifier' => $this->get(static::PRIMARY_KEY),
            'provider' => 'ebay',
            'name' => $this->get('title'),
            'description' => $this->get('', ''),
            'price' => $this->resolvePrice(),
            'currency' => $this->get('sellingStatus.currentPrice.currencyId', 'GBP'),
            'meta' => [
                'url' => $this->get('viewItemURL'),
                'best_offer_enabled' => $this->get('listingInfo.bestOfferEnabled'),
                'buy_it_now_available' => $this->get('listingInfo.buyItNowAvailable'),
                'images' => [
                    [
                        'url' => $this->get(
                            'galleryURL',
                            $this->get('imageURL')
                        ),
                    ],
                ],
                'categories' => [
                    'id' => $this->get('primaryCategory.categoryId'),
                    'name' => $this->get('primaryCategory.categoryName'),
                ],
                'sellerInfo' => [
                    'store' => $this->get('sellerInfo.sellerUserName'),
                    'feedbackScore' => $this->get('sellerInfo.feedbackScore'),
                    'feedbackPercent' => $this->get('sellerInfo.positiveFeedbackPercent'),
                    'topRatedSeller' => $this->get('sellerInfo.topRatedSeller'),
                ],
                'shippingInfo' => [
                    'shipping_cost' => $this->get('shippingInfo.shippingServiceCost.value'),
                    'shipping_type' => $this->get('shippingInfo.shippingType'),
                    'ship_to_locations' => $this->get('shippingInfo.shipToLocations'),
                ],
                'listingInfo' => [
                    'listing_type' => $this->get('listingInfo.listingType'),
                    'condition' => $this->get('condition.conditionId'),
                    'condition_display_name' => $this->get('condition.conditionDisplayName'),
                ],
            ],
            'metrics' => $this->getMetrics(),
            'store' => [
                'identifier' => $this->get('sellerInfo.sellerUserName'),
                'provider' => 'ebay',
            ],
        ];
    }

    /**
     * Get the price the product is selling for in pence.
     *
     * @return int
     */
    private function resolvePrice(): int
    {
        $base = $this->get(
            'sellingStatus.currentPrice.value',
            $this->get('buyItNowPrice.__value__')
        );

        return intval(+$base * 100);
    }

    /**
     * Get the keys that are collected as metrics.
     *
     * @return array
     */
    protected function metricKeys(): array
    {
        return [
            'watch_count' => 'listingInfo.watchCount',
            'price' => 'sellingStatus.currentPrice.value',
            'bid_count' => 'sellingStatus.bidCount',
        ];
    }
}
