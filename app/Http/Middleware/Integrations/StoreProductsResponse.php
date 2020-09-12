<?php

namespace App\Http\Middleware\Integrations;

use App\Models\Product;
use App\Repositories\MetadataRepository;
use App\Repositories\MetricsRepository;
use App\Repositories\StoresRepository;
use Closure;

class StoreProductsResponse
{
    /** @var \App\Repositories\MetadataRepository*/
    private $metadataRepository;

    /** @var \App\Repositories\MetricsRepository*/
    private $metricsRepository;

    /** @var \App\Repositories\StoresRepository*/
    private $storesRepository;

    public function __construct(MetadataRepository $metadataRepository, MetricsRepository $metricsRepository, StoresRepository $storesRepository)
    {
        $this->metadataRepository = $metadataRepository;
        $this->metricsRepository = $metricsRepository;
        $this->storesRepository = $storesRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Handle the termination of a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return mixed
     */
    public function terminate($request, $response)
    {
        collect($response->getData(true))
            ->map(function ($resource) {
                return [
                    'raw' => $resource,
                    'model' => Product::updateOrCreate([
                        'provider' => $resource['provider'],
                        'identifier' => $resource['identifier'],
                        'user_id' => auth()->user()->id,
                    ], $resource),
                ];
            })
            ->each(function ($product) {
                $this->metadataRepository->storeMany(
                    $product['model'],
                    collect($product['raw']['meta'] ?? [])
                );

                $this->metricsRepository->storeMany(
                    $product['model'],
                    collect($product['raw']['metrics'] ?? [])
                );

                $store = $this->storesRepository->store(
                    $product['raw']['store']
                );

                $this->storesRepository->linkProductToStore(
                    $store->id,
                    $product['model']->id
                );
            });
    }
}
