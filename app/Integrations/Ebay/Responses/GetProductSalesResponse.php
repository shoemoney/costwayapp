<?php

namespace App\Integrations\Ebay\Responses;

use Carbon\Carbon;
use App\Integrations\Http\Response;
use App\Collections\SalesCollection;
use App\Concerns\Scraping\ParsesHtml;
use App\Integrations\Ebay\Entities\Sale;

class GetProductSalesResponse extends Response
{
    use ParsesHtml;

    /**
     * Get the body attribute.
     *
     * @return mixed
     */
    public function getBody()
    {
        $this->parse($this->body);

        $sales = $this->first(".BHbidSecBorderGrey")
            ?? $this->dom->find("table ~ table")[3];
        $sales = $sales->find("tr")->toArray();

        try {
            $headers = $sales[0]->find("th");
            if (sizeof($headers) < 3) {
                $offset = 0;
                array_shift($sales);
            } else {
                $offset = trim($headers[2]->text()) == "Variation" ? 1 : 0;
            }
        } catch (\Exception $e) {
            $offset = 0;
        }

        array_shift($sales);

        $sales = array_map(function ($sale) use ($offset) {
            try {
                $cols = $sale->find("td");
                if (sizeof($cols) < 3 || $cols[2]->text() == "--") {
                    return;
                }

                preg_match("/(.)(\d{1,6}\.\d{2})$/", $cols[2 + $offset]->text(), $matches);

                return [
                    'price' => floatval($matches[2] ?? 0),
                    'currency' => $this->determineCurrencyCode($matches[1] ?? '£'),
                    'quantity' => floatval($cols[3 + $offset]->text()),
                    'sold_at' => Carbon::parse($cols[4 + $offset]->text())->toDateTimeString(),
                ];
            } catch (\Exception $e) {
                return null;
            }
        }, $sales);

        return SalesCollection::make($sales)->filter()->values()
            ->mapInto(Sale::class);
    }

    /**
     * Determine the ISO 4217 Currency Code based on the symbol.
     *
     * @param  string  $symbol
     * @return string
     */
    protected function determineCurrencyCode($symbol)
    {
        return [
            '£' => 'GBP'
        ][$symbol] ?? 'GBP';
    }
}
