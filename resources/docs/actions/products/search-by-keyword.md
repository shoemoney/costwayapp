# Searching for a product by keyword

When you need to lookup a product via in a provider, the best way to do it is via the integrations framework.

Each provider must have a `search()` method created on it which will give you access to the method for `keyword`.


## The keyword method

When searching for a keyword, we must give the method the actual keyword and the page number that we want to search on as all results are paginated.

```php
/**
 * Search products by a given keyword.
 *
 * @param  string  $keyword
 * @param  int  $page
 * @return \App\Integrations\Http\Response
 */
public function keyword(string $keyword, int $page = 1)
```

It is the job of the request to format your keyword for the request body, so avoid URL encoding your keyword prior to calling this method.

This method returns the response object prior to performing any processing on the response body. To perform your formatting or processing, you should call the `getBody()` method on the response; alternatively you can cast it as an array or return in via a Laravel Controller.

The typical calling of this method would look like this:

```php
$products = integration($provider)
    ->search()
    ->keyword($keyword, $pageNumber)
    ->getBody();
```

## Via HTTP Request

If you are required to search for a product via a keyword and have to use a HTTP request, then you can make a request to:

```http
/products/{provider}?keyword={keyword}&page={pageNumber}
```

In doing this, your response will be an array of product objects.
