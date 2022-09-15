<?php

namespace Checkout\Donate\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template;
use Magento\Framework\App\ObjectManager;
use Magento\Sales\Model\Order;

class DonateField extends Template
{
    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getValueDonate()
    {
        // Get orderId params
        $orderId = $this->getRequest()->getParams();
        $objectManager = ObjectManager::getInstance();

        $orderById = $objectManager->create(Order::class)->load($orderId)->getData();

        return $orderById['custom_donate'];
    }

}
