<?php

namespace Product\Content\Plugin\Quote\Address;

use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Quote\Model\Quote\Item;

class Rate
{
    const TITLE_SHIPPING = 'Free Shipping';
    const PRICE_SHIPPING = 0;

    private $session;
    private $scopeConfig;

    public function __construct
    (
        Session $session,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->session =  $session;
        $this->scopeConfig = $scopeConfig;
    }

    public function afterImportShippingRate($subject, $result, $rate)
    {
        if ($rate instanceof \Magento\Quote\Model\Quote\Address\RateResult\Method) {

            $checkProductFree = $this->checkProductFree();
            $checkTotals = $this->checkTotalPriceProducts();

            if($checkProductFree == 1 || $checkTotals){
                $result->setPrice(
                    self::PRICE_SHIPPING
                )->setMethodTitle(
                    self::TITLE_SHIPPING
                )->setCarrierTitle(
                    self::TITLE_SHIPPING
                );
            }
        }
        return $result;
    }

    public function productsCart(): ?array
    {

        $quoteId = $this->session->getQuoteId();

        $objectManager = ObjectManager::getInstance();
        return $objectManager->create(Item::class)->getCollection()
            ->addFieldToFilter('quote_id', $quoteId)->getData();
    }

    public function checkTotalPriceProducts (): bool
    {
        $productsQuote = $this->productsCart();

        //Get free shipping total
        $freeTotal = $this->scopeConfig->getValue('carriers/simpleshipping/freeshipping');

        //TotalsPrice
        $totals = 0;
        foreach ($productsQuote as $item){
            $totals += $item['row_total'];
        }

        if($totals >= $freeTotal){
            $check = true;
        }else{
            $check = false;
        }

        return $check;
    }

    public  function checkProductFree (): int
    {
        $productsQuote = $this->productsCart();

        $products = [];
        foreach ($productsQuote as $item) {
            $products[] = $item['product_id'];
        }

        // check field free products
        $result = 0;
        $objectManager = ObjectManager::getInstance();

        foreach ($products as $item) {
            $product = $objectManager->create(Product::class)->load($item);
            if($product['free_shipping'] == 1  ){
                $result = 1;
            }
        }
        return $result;
    }
}

