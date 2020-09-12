<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupedSaleResourceCollection extends ResourceCollection
{
    private $frequencyFormats = [
        // 'month' => 'Y-m',
        'day' => 'Y-m-d',
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->groupBy($request->query('groupBy', 'day'));
    }

    /**
     * Group the collection by the given frequency.
     *
     * @param  string  $frequency
     * @return \Illuminate\Support\Collection
     */
    protected function groupBy($frequency)
    {
        $dateFormat = $this->frequencyFormats[$frequency] ?? 'Y-m-d';

        $grouped = $this->collection
            ->groupBy(function ($sale) use ($frequency, $dateFormat) {
                return $sale->sold_at->format($dateFormat);
            })->map(function ($sales, $date) {
                return [
                    'total_sold' => $sales->sum('quantity'),
                    'total_made' => +sprintf("%.2f", $sales->sum('total_cost'))
                ];
            });

        $dates = [];

        $date = now();
        while (now()->subYear()->lt($date)) {
            $dates[] = $date->format($dateFormat);
            $date->subDay();
        }

        $values = array_fill(0, count($dates), ['total_sold' => 0, 'total_made' => 0]);

        $response = array_combine($dates, $values);

        $grouped->each(function ($value, $date) use (&$response) {
            $response[$date] = $value;
        });

        return collect($response)->map(function ($value, $date) {
            return array_merge([
                'date' => $date,
            ], $value);
        })->values();
    }
}
