<?php

namespace App\Integrations\Ebay\Import;

use App\Models\TrackedProduct;
use DTS\eBaySDK\Trading\Enums;
use DTS\eBaySDK\Trading\Types as Trading;
use Hkonnet\LaravelEbay\Ebay;
use Hkonnet\LaravelEbay\EbayServices;

class ImportProduct
{

    /**
     * Import product into ebay
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function ImportSimpleProduct(array $data)
    {
        // Create link for the imported product
        (new TrackedProduct())->createLink([
            'identifier' => $data['identifier'],
            'name' => $data['description'] ?? $data['title'],
            'store' => $data['store'],
            'provider' => 'ebay',
        ]);
        /**
         * Create the service object.
         */
        $ebay_service = new EbayServices();
        $service = $ebay_service->createTrading();

        /**
         * Create the request object.
         */
        $request = new Trading\AddFixedPriceItemRequestType();

        /**
         * An user token is required when using the Trading service.
         */
        $ebay = new Ebay();
        $request->RequesterCredentials = new Trading\CustomSecurityHeaderType();
        $authToken = $ebay->getAuthToken();
        $request->RequesterCredentials->eBayAuthToken = $authToken;

        /**
         * Begin creating the fixed price item.
         */
        $item = new Trading\ItemType();
        /**
         * We want a multiple quantity fixed price listing.
         */
        $item->ListingType = Enums\ListingTypeCodeType::C_FIXED_PRICE_ITEM;
        $item->Quantity = $data['quantity'];
        /**
         * Let the listing be automatically renewed every 30 days until cancelled.
         */
        $item->ListingDuration = Enums\ListingDurationCodeType::C_DAYS_30;

        $item->StartPrice = new Trading\AmountType(['value' => floatval($data['price'])]);
        /**
         * Allow buyers to submit a best offer.
         */
        $item->BestOfferDetails = new Trading\BestOfferDetailsType();
        $item->BestOfferDetails->BestOfferEnabled = true;
        /**
         * Automatically accept best offers of 17.99 and decline offers lower than 15.99.
         */
        //$item->ListingDetails = new Trading\ListingDetailsType();
        //$item->ListingDetails->BestOfferAutoAcceptPrice = new Trading\AmountType(['value' => 17.99]);
        //$item->ListingDetails->MinimumBestOfferPrice = new Trading\AmountType(['value' => 15.99]);
        /**
         * Provide a title and description and other information such as the item's location.
         * Note that any HTML in the title or description must be converted to HTML entities.
         */
        $item->Title = $data['title'];
        $item->Description = $data['description'] ?? $data['title'];
        $item->SKU = $data['sku'];
        $item->Country = 'GB';
        $item->Location = 'Worcester';
        $item->PostalCode = 'WR1 2PD';

        /**
         * This is a required field.
         */
        $item->Currency = 'GBP';
        /**
         * Display a picture with the item.
         */

        $item->ProductListingDetails = new Trading\ProductListingDetailsType();
        $item->ProductListingDetails->UPC = 'Does not apply';
        $item->ProductListingDetails->EAN = 'Does not apply';

        $item->ItemSpecifics = new Trading\NameValueListArrayType();

        $specific = new Trading\NameValueListType();
        $specific->Name = 'Brand';
        $specific->Value[] = 'BrandValue';
        $item->ItemSpecifics->NameValueList[] = $specific;

        $specific = new Trading\NameValueListType();
        $specific->Name = 'MPN';
        $specific->Value[] = 'MPNValue';
        $item->ItemSpecifics->NameValueList[] = $specific;

        $item->PictureDetails = new Trading\PictureDetailsType();
        $item->PictureDetails->GalleryType = Enums\GalleryTypeCodeType::C_GALLERY;
        $item->PictureDetails->PictureURL = [$data['images']];
        /**
         * List item in the Sporting > Other sporting goods (310) category.
         * url to find categories: https://www.isoldwhat.com/getcats/index.php?RootID=888#888
         */
        $item->PrimaryCategory = new Trading\CategoryType();
        $item->PrimaryCategory->CategoryID = $data['category_id'];
        /**
         * Tell buyers what condition the item is in.
         * For the category that we are listing in the value of 1000 is for Brand New.
         */
        $item->ConditionID = 1000;
        /**
         * Buyers can use one of two payment methods when purchasing the item.
         * PayPal
         * The item will be dispatched within 1 business days once payment has cleared.
         * Note that you have to provide the PayPal account that the seller will use.
         * This is because a seller may have more than one PayPal account.
         */
        $item->PaymentMethods = [
            'PayPal',
        ];
        $item->PayPalEmailAddress = 'joshuajordancallis@gmail.com';
        $item->DispatchTimeMax = 1;
        /**
         * Setting up the shipping details.
         * We will use a Flat shipping rate for both domestic and international.
         */
        $item->ShippingDetails = new Trading\ShippingDetailsType();
        $item->ShippingDetails->ShippingType = Enums\ShippingTypeCodeType::C_FLAT;
        /**
         * Create our first domestic shipping option.
         * Offer the Economy Shipping (1-10 business days) service at 2.00 for the first item.
         * Additional items will be shipped at 1.00.
         */
        $shippingService = new Trading\ShippingServiceOptionsType();
        $shippingService->ShippingServicePriority = 1;
        $shippingService->ShippingService = 'UK_myHermesDoorToDoorService';
        $shippingService->ShippingServiceCost = new Trading\AmountType(['value' => (double) $data['shipping_cost']]);
        $item->ShippingDetails->ShippingServiceOptions[] = $shippingService;

        /**
         * The return policy.
         * Returns are accepted.
         * A refund will be given as money back.
         * The buyer will have 14 days in which to contact the seller after receiving the item.
         * The buyer will pay the return shipping cost.
         */
        $item->ReturnPolicy = new Trading\ReturnPolicyType();
        $item->ReturnPolicy->ReturnsAcceptedOption = 'ReturnsAccepted';
        $item->ReturnPolicy->RefundOption = 'MoneyBack';
        $item->ReturnPolicy->ReturnsWithinOption = 'Days_14';
        $item->ReturnPolicy->ShippingCostPaidByOption = 'Buyer';
        /**
         * Finish the request object.
         */
        $request->Item = $item;

        /**
         * Send the request.
         */
        $response = $service->addFixedPriceItem($request);

        /**
         * Output the result of calling the service operation.
         */
        if ($response->Ack === 'Failure') {
            if (isset($response->Errors)) {
                foreach ($response->Errors as $error) {
                    printf(
                        "%s: %s\n%s\n\n",
                        $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                        $error->ShortMessage,
                        $error->LongMessage
                    );
                }
            }
        }
        return $response;
    }

    /**
     * Import product with variations into ebay store
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function ImportVariationProduct(array $data)
    {
        /**
         * Request data
         */

        /**
         * Create the service object.
         */
        $ebay_service = new EbayServices();
        $service = $ebay_service->createTrading();

        /**
         * Create the request object.
         */
        $request = new Trading\AddFixedPriceItemRequestType();

        /**
         * An user token is required when using the Trading service.
         */
        $ebay = new Ebay();
        $request->RequesterCredentials = new Trading\CustomSecurityHeaderType();
        $authToken = $ebay->getAuthToken();
        //dd($authToken);
        $request->RequesterCredentials->eBayAuthToken = $authToken;

        /**
         * Begin creating the fixed price item.
         */
        $item = new Trading\ItemType();

        /**
         * The item is T-Shirts in various color and sizes.
         */
        $item->Title = $mainItemTitle;
        $item->Description = $mainItemDescription;
        /**
         * List in the Clothing, Shoes & Accessories > Men's Clothing > T-Shirts (15687) category.
         */
        $item->PrimaryCategory = new Trading\CategoryType();
        $item->PrimaryCategory->CategoryID = $data['category']; //'15687'
        /**
         * The item will be T-Shirts in different colors that are available in several sizes.
         *
         * | SKU    | Color | Size (Men's) | Quantity | Price |
         * |--------------------------------------------------|
         * | LI-R-S | Red   | S            | 10       | 9.99  |
         * | LI-R-M | Red   | M            | 10       | 9.99  |
         * | LI-R-L | Red   | L            | 10       | 9.99  |
         * | LI-W-S | White | S            | 5        | 10.99 |
         * | LI-W-M | White | M            | 5        | 10.99 |
         * | LI-B-L | Blue  | L            | 10       | 9.99  |
         */
        $item->Variations = new Trading\VariationsType();
        /**
         * Before we specify the variations we need to inform eBay all the possible
         * names and values that the listing could use over its life time.
         */
        $variationSpecificsSet = new Trading\NameValueListArrayType();

        $nameValue = new Trading\NameValueListType();
        $nameValue->Name = 'Color';
        $nameValue->Value = ['Red', 'White', 'Blue'];
        $variationSpecificsSet->NameValueList[] = $nameValue;

        $nameValue = new Trading\NameValueListType();
        $nameValue->Name = "Size (Men's)";
        $nameValue->Value = ['S', 'M', 'L'];
        $variationSpecificsSet->NameValueList[] = $nameValue;
        $item->Variations->VariationSpecificsSet = $variationSpecificsSet;
        /**
         * Now that we have specified the variations Ebay can use for it's life time
         * We need to create the variations...
         */

        $item->Variations->Variation[] = new Trading\VariationType([
            'SKU' => 'LI-W-S',
            'Quantity' => 5,
            'StartPrice' => new Trading\AmountType(['value' => 10.99]),
            'VariationSpecifics' => [new Trading\NameValueListArrayType([
                'NameValueList' => [
                    new Trading\NameValueListType(['Name' => 'Color', 'Value' => ['White']]),
                    new Trading\NameValueListType(['Name' => "Size (Men's)", 'Value' => ['S']]),
                ],
            ])],
        ]);

        $item->Variations->Variation[] = new Trading\VariationType([
            'SKU' => 'LI-W-M',
            'Quantity' => 5,
            'StartPrice' => new Trading\AmountType(['value' => 10.99]),
            'VariationSpecifics' => [new Trading\NameValueListArrayType([
                'NameValueList' => [
                    new Trading\NameValueListType(['Name' => 'Color', 'Value' => ['White']]),
                    new Trading\NameValueListType(['Name' => "Size (Men's)", 'Value' => ['M']]),
                ],
            ])],
        ]);
        /**
         * Variation
         * SKU          - LI-B-L
         * Color        - Blue
         * Size (Men's) - L
         * Quantity     - 10
         * Price        - 9.99
         */
        $item->Variations->Variation[] = new Trading\VariationType([
            'SKU' => 'LI-B-L',
            'Quantity' => 10,
            'StartPrice' => new Trading\AmountType(['value' => 9.99]),
            'VariationSpecifics' => [new Trading\NameValueListArrayType([
                'NameValueList' => [
                    new Trading\NameValueListType(['Name' => 'Color', 'Value' => ['Blue']]),
                    new Trading\NameValueListType(['Name' => "Size (Men's)", 'Value' => ['L']]),
                ],
            ])],
        ]);

        /**
         * Variation
         * SKU          - LI-R-S
         * Color        - Red
         * Size (Men's) - S
         * Quantity     - 10
         * Price        - 8.99
         */
        $item->Variations->Variation[] = new Trading\VariationType([
            'SKU' => 'LI-R-S',
            'Quantity' => 10,
            'StartPrice' => new Trading\AmountType(['value' => 8.99]),
            'VariationSpecifics' => [new Trading\NameValueListArrayType([
                'NameValueList' => [
                    new Trading\NameValueListType(['Name' => 'Color', 'Value' => ['Red']]),
                    new Trading\NameValueListType(['Name' => "Size (Men's)", 'Value' => ['S']]),
                ],
            ])],
        ]);

        /**
         * Variation
         * SKU          - LI-R-M
         * Color        - Red
         * Size (Men's) - M
         * Quantity     - 10
         * Price        - 9.99
         */
        $item->Variations->Variation[] = new Trading\VariationType([
            'SKU' => 'LI-R-M',
            'Quantity' => 10,
            'StartPrice' => new Trading\AmountType(['value' => 9.99]),
            'VariationSpecifics' => [new Trading\NameValueListArrayType([
                'NameValueList' => [
                    new Trading\NameValueListType(['Name' => 'Color', 'Value' => ['Red']]),
                    new Trading\NameValueListType(['Name' => "Size (Men's)", 'Value' => ['M']]),
                ],
            ])],
        ]);

        /**
         * Specific the images for each variation
         */

        $pictures = new Trading\PicturesType();
        $pictures->VariationSpecificName = 'Color';

        foreach ($data['pictureType'] as $pictureType) {
            $pictureSet = new Trading\VariationSpecificPictureSetType();
            $pictureSet->VariationSpecificValue = $pictureType['Value'];
            $pictureSet->PictureURL = $pictureType['PictureUrl'];
            $pictures->VariationSpecificPictureSet[] = $pictureSet;
        }

        $item->Variations->Pictures[] = $pictures;

        $item->ItemSpecifics = new Trading\NameValueListArrayType();

        foreach ($data['listType'] as $listType) {
            $specific = new Trading\NameValueListType();
            $specific->Name = $listType['Name'];
            $specific->Value[] = $listType['Value'];
            $item->ItemSpecifics->NameValueList[] = $specific;
        }

        /**
         * This shows an alternative way of adding a specific.
         */
        $item->ItemSpecifics->NameValueList[] = new Trading\NameValueListType([
            'Name' => 'Style',
            'Value' => ['Basic Tee'],
        ]);

        foreach ($data['nameValueList'] as $nameValueList) {
            $specific = new Trading\NameValueListType();
            $specific->Name = $data['nameValueList']['itemSpecifics']['Name'];
            $specific->Value[] = $data['nameValueList']['itemSpecifics']['Value'];
            $item->ItemSpecifics->NameValueList[] = $specific;
        }

        /**
         * Provide enough information so that the item is listed.
         * It is beyond the scope of this example to go into any detail.
         */
        $item->ListingType = Enums\ListingTypeCodeType::C_FIXED_PRICE_ITEM;
        $item->ListingDuration = Enums\ListingDurationCodeType::C_DAYS_30;
        $item->Country = $data['address']['country'];
        $item->Location = $data['address']['location'];
        $item->PostalCode = $data['address']['postCode'];
        $item->Currency = $data['address']['currency'];

        $item->ConditionID = 1000;
        /**
         * Buyers can use one of two payment methods when purchasing the item.
         * PayPal
         * The item will be dispatched within 1 business days once payment has cleared.
         * Note that you have to provide the PayPal account that the seller will use.
         * This is because a seller may have more than one PayPal account.
         */
        $item->PaymentMethods = [
            'PayPal',
        ];
        $item->PayPalEmailAddress = 'example@example.com';
        $item->DispatchTimeMax = 1;
        /**
         * Setting up the shipping details.
         * We will use a Flat shipping rate for both domestic and international.
         */
        $item->ShippingDetails = new Trading\ShippingDetailsType();
        $item->ShippingDetails->ShippingType = Enums\ShippingTypeCodeType::C_FLAT;
        /**
         * Create our first domestic shipping option.
         * Offer the Economy Shipping (1-10 business days) service at 2.00 for the first item.
         * Additional items will be shipped at 1.00.
         */
        $shippingService = new Trading\ShippingServiceOptionsType();
        $shippingService->ShippingServicePriority = 1;
        $shippingService->ShippingService = 'UK_myHermesDoorToDoorService';
        $shippingService->ShippingServiceCost = new Trading\AmountType(['value' => 2.00]);
        $shippingService->ShippingServiceAdditionalCost = new Trading\AmountType(['value' => 1.00]);
        $item->ShippingDetails->ShippingServiceOptions[] = $shippingService;

        $item->ReturnPolicy = new Trading\ReturnPolicyType();
        $item->ReturnPolicy->ReturnsAcceptedOption = 'ReturnsAccepted';
        /**
         * Finish the request object.
         */
        $request->Item = $item;
        /**
         * Send the request.
         */
        $response = $service->addFixedPriceItem($request);
        /**
         * Output the result of calling the service operation.
         */
        if ($response->Ack == 'Failure') {
            if (isset($response->Errors)) {
                foreach ($response->Errors as $error) {
                    printf(
                        "%s: %s\n%s\n\n",
                        $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                        $error->ShortMessage,
                        $error->LongMessage
                    );
                }
            }
        }

        return $response;
    }
}
