<?php

namespace Product\Content\Block\Product;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;
use Product\Content\Model\ProductContent;

class TabDetails extends Template
{
    protected $_product = null;
    private $_coreRegistry;

    public function __construct(
        Template\Context $context,
        RequestInterface $request,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_request = $request;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    public function getProductContent(): ?array
    {
        $this->getProduct();
        $objectManager = ObjectManager::getInstance();

        //Get id params
        $productId = $this->_request->getParam('id');
        // Filter product id = id params & display area = top -> return
        return $objectManager->create(ProductContent::class)->getCollection()
                ->addFieldToFilter('is_active', 1)
                ->addFieldToFilter('product_id', $productId)
                ->addFieldToFilter('display_area', 1)->getData();

    }

    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

}
