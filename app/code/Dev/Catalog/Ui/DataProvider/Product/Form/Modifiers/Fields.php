<?php

namespace Dev\Catalog\Ui\DataProvider\Product\Form\Modifiers;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Dev\Catalog\Model\ExpertReviewFactory;

class Fields extends AbstractModifier
{
    private $locator;
    protected $expertRv;

    public function __construct(
        LocatorInterface $locator,
        ExpertReviewFactory $expertRv
    ) {
        $this->locator = $locator;
        $this->expertRv = $expertRv;
    }
    public function modifyData(array $data): array
    {
        $product   = $this->locator->getProduct();

        $productId = $product->getId();
        // Lọc bản ghi trong expert review xem có bản ghi có product_id nào hợp lệ tồn tại k ?
        $epReview = $this->expertRv->create()->getCollection()->addFieldToFilter('product_id', $productId)->getFirstItem()->getData();

        if(!empty($epReview)){
            $epReview['expert_list'] = json_decode($epReview['expert_list']);
        }else{
            $epReview = [];
        }

        return array_replace_recursive(

            $data, [
            $productId => [
                'expert_review' => $epReview
            ]
        ]);
    }

    public function modifyMeta(array $meta): array
    {
        // Disable Expert Review trong form

//        $invalid = true;
//        if ($invalid) {
//            $meta['expert_review']['arguments']['data']['config'] = [
//                'disabled' => true,
//                'visible'  => false
//            ];
//        } else {
//            $meta['expert_review']['arguments']['data']['config'] = [
//                'disabled' => false,
//                'visible'  => true
//            ];
//        }
        //...

        return $meta;
    }
}
