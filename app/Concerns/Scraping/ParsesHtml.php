<?php

namespace App\Concerns\Scraping;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;

trait ParsesHtml
{
    /** @var \PHPHtmlParser\Dom */
    protected $dom;

    /**
     * Parse the given HTML.
     *
     * @var  string  $html
     * @return \PHPHtmlParser\Dom
     */
    public function parse($html)
    {
        return $this->createDomObject($html);
    }

    /**
     * Create a new Dom instance with the given html.
     *
     * @param  string  $html
     * @return \PHPHtmlParser\Dom
     */
    protected function createDomObject($html)
    {
        return $this->dom = (new Dom)->load($html);
    }

    /**
     * Find the first instance of a HtmlNode.
     *
     * @param  string  $selector
     * @return \PHPHtmlParser\Dom\HtmlNode|null
     */
    public function first($selector)
    {
        return $this->dom->find($selector)[0]
            ?? null;
    }

    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return method_exists($this->dom, $method)
            ? $this->dom->{$method}(...$parameters)
            : null;
    }
}
