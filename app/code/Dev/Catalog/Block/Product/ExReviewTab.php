<?php

namespace Dev\Catalog\Block\Product;

use Dev\Catalog\Model\Expert;
use Dev\Catalog\Model\ExpertReview;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Template;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;

class ExReviewTab extends Template
{
    protected $request;

    public function __construct(
        RequestInterface $request,
        Context $context,
        array $data = []
    )
    {
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getDataExpertTab(){
        $objectManager = ObjectManager::getInstance();

        //Get id product to params
        $productId = $this->request->getParams();
        //Get expert review by product id
        $expertReview = $objectManager->create(ExpertReview::class)->getCollection()->addFieldToFilter('product_id', $productId)
            ->getFirstItem()->getData();

        if(!empty($expertReview)){
            $expertList = json_decode($expertReview['expert_list']);

            $expertReview['product_name'] = $objectManager->create(Product::class)->load($productId)->getName();
                foreach ($expertList as $index => $item){
                    $expertReview['expert_name'][] = $objectManager->create(Expert::class)->load($item)->getName();
                }
        }else{

            echo "<h2> Sản phẩm không có đánh giá !!! </h2>";

        }

        return $expertReview;

    }

}
