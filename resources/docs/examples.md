# Importing Products
## Import Simple Product
```
$productRequest = new App\Integrations\Ebay\Requests\ImportProductRequest();
dd($productRequest->export());
```

## Import Variation Product
```
$productRequest = new App\Integrations\Ebay\Requests\ImportProductRequest();
dd($productRequest->exportVariation());

```

## Get all categories from Ebay
```
$categories = new App\Integrations\Ebay\Categories\GetCategories();
dd($categories->all());
```

# Searching products
## By Keyword

```
$provider = app(\App\Integrations\IntegrationFactory::class)->makeProvider('ebay');
$keyword = 'drone';

$provider
    ->search()
    ->keyword($keyword)
    ->getBody()
```

## By Category

```
$provider = app(\App\Integrations\IntegrationFactory::class)->makeProvider('ebay');
$categoryId = 1;

$provider
    ->search()
    ->category($categoryId)
    ->getBody()
```

## By Seller

```
$provider = app(\App\Integrations\IntegrationFactory::class)->makeProvider('ebay');
$sellerName = 'jjcallis';

$provider
    ->search()
    ->category($sellerName)
    ->getBody()
```

# Look up items

This feature will give you more information than when searching using the above.

## Single Item
```
$provider = app(\App\Integrations\IntegrationFactory::class)->makeProvider('ebay');
$itemId = '283681452620';

$provider
    ->search()
    ->items($itemId)
    ->getBody()
```

## Multiple Items
```
$provider = app(\App\Integrations\IntegrationFactory::class)->makeProvider('ebay');
$itemIds = ['283681452620', '114027108125'];

$provider
    ->search()
    ->items($itemIds)
    ->getBody()
```

## Sales per day for a product

```
$sales = collect(
    scrape('ebay')->product(
        'https://www.ebay.com/itm/Crafters-Rock-Collection-1-Lb-Mix-Gems-Crystals-Natural-Mineral-Specimens-/390495578126'
    )['sales']
)
    ->groupBy(function ($sale) {
        return Carbon\Carbon::parse($sale['ordered_at'])->toDateString();
    })
    ->map(function ($collection) {
        return [
            'quantity' => $collection->sum("quantity"),
            'income' => $collection
                ->map(function ($sale) {
                    preg_match("/\d{1,}\.\d{1,2}/", $sale['price'], $matches);
                    return $sale['quantity'] * ($matches[0] ?? 0);
                })
                ->sum()
        ];
    });

collect(range(0, 30))->mapWithKeys(function ($days) use ($sales) {
    $date = now()
        ->subDays($days)
        ->toDateString();
    return [$date => $sales[$date] ?? ['quantity' => 0, 'income' => 0]];
});
```