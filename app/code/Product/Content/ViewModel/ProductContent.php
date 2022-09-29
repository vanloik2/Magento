<?php

namespace Product\Content\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductContent implements ArgumentInterface
{

    /**
     * @var RequestInterface
     */
    private $_request;
    /**
     * @var \Zend_Filter_Interface
     */
    private $templateProcessor;

    public function __construct(
        RequestInterface $request,
        \Zend_Filter_Interface $templateProcessor
    )
    {
        $this->_request = $request;
        $this->templateProcessor = $templateProcessor;
    }

    public function getProductContent(): ?array
    {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        //Get id params
        $productId = $this->_request->getParam('id');
        // Filter product id = id params & display area = top -> return
        return $objectManager->create(\Product\Content\Model\ProductContent::class)->getCollection()
            ->addFieldToFilter('is_active', 1)
            ->addFieldToFilter('entity_id', $productId)->getData();

    }
    //get display area
    public function getDisplayArea() : array {
        $products = $this->getProductContent();

        $displayArea = [];
        foreach ($products as $product) {
            $displayArea[] = $product['display_area'];
        }
        return $displayArea;
    }
    //get content
    public function getContent(): array
    {
        $products = $this->getProductContent();

        $content = [];
        foreach ($products as $product) {
            $content[] = $product['content'];
        }
        return $content;
    }
    //convert content
    public function filterOutputHtml($string)
    {
        return $this->templateProcessor->filter($string);
    }
}
