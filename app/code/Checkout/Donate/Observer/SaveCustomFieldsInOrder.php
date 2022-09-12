<?php
namespace Checkout\Donate\Observer;

class SaveCustomFieldsInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        // Thêm data vào cột custom_donate trong bảng sales_order
        $order->setData('custom_donate', $quote->getCustomDonate());

        return $this;
    }
}
