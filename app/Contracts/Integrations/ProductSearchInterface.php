<?php

namespace App\Contracts\Integrations;

interface ProductSearchInterface
{
    /**
     * Search a product category by a given identifier.
     *
     * @param  mixed  $identifier
     * @return \App\Integrations\Http\Response
     */
    public function category($identifier);

    /**
     * Search products by a given keyword.
     *
     * @param  string  $keyword
     * @param  int  $page
     * @return \App\Integrations\Http\Response
     */
    public function keyword(string $keyword, int $page = 1);

    /**
     * Search a given store's products.
     *
     * @param  string  $identifier
     * @param  int  $page
     * @return \App\Integrations\Http\Response
     */
    public function store(string $identifier, int $page = 1);
}
