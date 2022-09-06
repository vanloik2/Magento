<?php
namespace Dev\Catalog\Block;

use Dev\Catalog\Model\Expert;
use Dev\Catalog\Model\ExpertReview;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Index extends Template
{

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getListExpertReview()
    {
        // Khai báo để sử dụng objectManager
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        // List ExpertRv
        $expertRv = $objectManager->create(ExpertReview::class)->getCollection()->getData();

        // Lấy name expert & product
        foreach($expertRv as $index => $value){
            $productName = $objectManager->create(Product::class)->load($value['product_id'])->getName();
            $expertName = $objectManager->create(Expert::class)->load($value['expert_id'])->getName();
            // add -> expertRv
            $expertRv[$index]['product_name'] = $productName;
            $expertRv[$index]['expert_name'] = $expertName;
        }

        return $expertRv;

    }
}
