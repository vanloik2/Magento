<?php

namespace Product\Content\Block\Product;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Product\Content\Model\ProductContent;

class TabDetails extends Template
{
    public function __construct(
        Template\Context $context,
        RequestInterface $request
    )
    {
        $this->_request = $request;
        parent::__construct($context);
    }

    public function getProductContent(): ?array
    {
        $objectManager = ObjectManager::getInstance();

        //Get id params
        $productId = $this->_request->getParam('id');
        // Filter product id = id params & display area = top -> return
        return $objectManager->create(ProductContent::class)->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->addFieldToFilter('display_area', 1)->getData();
    }
}
