<?php

namespace App\Integrations\Ebay;

use Hkonnet\LaravelEbay\Ebay;
use Hkonnet\LaravelEbay\EbayServices;
use DTS\eBaySDK\Trading\Enums\SeverityCodeType;
use DTS\eBaySDK\Trading\Types\CustomSecurityHeaderType;
use DTS\eBaySDK\Trading\Types\GetCategoriesRequestType;

class CategoriesProvider extends Provider
{
    /**
     * Get all categories.
     *
     * @return
     */
    public function all()
    {
        // Create the service object.
        $ebay_service = new EbayServices();
        $service = $ebay_service->createTrading();

        // Create the request object.
        $request = new GetCategoriesRequestType();

        // An user token is required when using the Trading service.
        $ebay = new Ebay();
        $request->RequesterCredentials = new CustomSecurityHeaderType();
        $authToken = $ebay->getAuthToken();
        $request->RequesterCredentials->eBayAuthToken = $authToken;

        // By specifying 'ReturnAll' we are telling the API return the full category hierarchy.
        $request->DetailLevel = ['ReturnAll'];

        /**
         * OutputSelector can be used to reduce the amount of data returned by the API.
         * http://developer.ebay.com/DevZone/XML/docs/Reference/ebay/GetCategories.html#Request.OutputSelector
         */
        $request->OutputSelector = [
            'CategoryArray.Category.CategoryID',
            'CategoryArray.Category.CategoryParentID',
            'CategoryArray.Category.CategoryLevel',
            'CategoryArray.Category.CategoryName',
        ];


        // Send the request.
        $response = $service->getCategories($request);

        // Output the result of calling the service operation.
        if (isset($response->Errors)) {
            foreach ($response->Errors as $error) {
                printf(
                    "%s: %s\n%s\n\n",
                    $error->SeverityCode === SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                    $error->ShortMessage,
                    $error->LongMessage
                );
            }
        }

        $categories = [];

        if ($response->Ack !== 'Failure') {
            foreach ($response->CategoryArray->Category as $category) {
                $categories[] = [
                    'identifier' => $category->CategoryID,
                    'name' => $category->CategoryName,
                    'parent_id' => $category->CategoryParentID->current(),
                ];
            }
        }
        return $categories;
    }
}
