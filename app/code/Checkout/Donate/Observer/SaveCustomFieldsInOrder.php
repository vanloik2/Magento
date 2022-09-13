<?php
namespace Checkout\Donate\Observer;

class SaveCustomFieldsInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        // add data to column custom_donate in table sales_order
        $order->setData('custom_donate', $quote->getCustomDonate());

        return $this;
    }
}
