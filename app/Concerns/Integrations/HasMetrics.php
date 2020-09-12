<?php

namespace App\Concerns\Integrations;

trait HasMetrics
{
    /**
     * Get the keys that are collected as metrics.
     *
     * @return array
     */
    protected function metricKeys(): array
    {
        return [];
    }

    /**
     * Get the metrics from the entity.
     *
     * @return array
     */
    protected function getMetrics()
    {
        return collect($this->metricKeys())
            ->map(function ($metric) {
                return $this->get($metric);
            })->filter()
            ->toArray();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(
            $this->data,
            ['metrics' => $this->getMetrics()]
        );
    }
}
