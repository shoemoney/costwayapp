<?php

namespace App\Scraping\Providers\Ebay;

use Carbon\Carbon;
use App\Concerns\Scraping\ParsesHtml;
use App\Concerns\Scraping\MakesRequests;

class SalesScraper
{
    use ParsesHtml;
    use MakesRequests;

    /** @var array */
    protected $sales = [];

    /** @var string */
    protected $url = "";

    /**
     * @param  string  $id
     * @return void
     */
    public function __construct($id)
    {
        $this->url = $this->makeUrl($id);
    }

    /**
     * Make the URL required to scrape a product's sales.
     *
     * @param  string  $id
     * @return string
     */
    protected function makeUrl($id)
    {
        return "https://offer.ebay.co.uk/ws/eBayISAPI.dll?ViewBidsLogin&item={$id}";
    }

    /**
     * Scrape a product's sales page.
     *
     * @param  array  $options
     * @return $this
     */
    public function scrape($options = [])
    {
        $this->parse(
            $this->httpClient()->get($this->url)
        );

        $sales = $this->first(".BHbidSecBorderGrey")->find("tr")->toArray();

        array_shift($sales);
        array_shift($sales);

        $sales = array_map(function ($sale) {
            $cols = $sale->find("td");
            if (sizeof($cols) < 3) {
                return;
            }

            return [
                'user' => str_replace(["( )", "(  )"], "", $cols[1]->text()),
                'price' => $cols[2]->text(),
                'quantity' => $cols[3]->text(),
                'ordered_at' => $cols[4]->text()
            ];
        }, $sales);

        $this->sales = collect($sales)->filter()->toArray();

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->sales;
    }

    /**
     * Get the sales over the last 30 days (grouped by day).
     *
     * @return array
     */
    public function last30Days(): array
    {
        $sales = collect($this->sales)
            ->groupBy(function ($sale) {
                return Carbon::parse($sale['ordered_at'])->toDateString();
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

        return collect(range(0, 30))->mapWithKeys(function ($days) use ($sales) {
            $date = now()
                ->subDays($days)
                ->toDateString();
            return [$date => $sales[$date] ?? ['quantity' => 0, 'income' => 0]];
        })->toArray();
    }
}
