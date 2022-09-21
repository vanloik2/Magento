<?php

namespace Dev\Catalog\Observer;

use Dev\Catalog\Model\ExpertReviewFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;

class HandleSaveProduct implements ObserverInterface
{
    protected $request;
    protected $expertReviewFactory;
    protected $productFactory;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        ExpertReviewFactory $expertReviewFactory,
        ProductFactory $productFactory,
    )
    {
        $this->request = $request;
        $this->expertReviewFactory = $expertReviewFactory;
        $this->productFactory = $productFactory;
    }

    public function execute(Observer $observer)
    {
        $params = $this->request->getParams();

        $customFieldData = $params['expert_review'];

        $model = $this->expertReviewFactory->create();

        // Save bản ghi
        $model->setData($customFieldData);

        //Kiểm tra có id hay k và gán cho $model
        if(empty($params['id'])){
            $idPro = $this->productFactory->create()->getCollection()->addFieldToSelect('entity_id')->setOrder('entity_id', 'DESC')->getFirstItem()['entity_id'] + 1;
            $model['product_id'] = $idPro;
        }else{
            $model['product_id'] = $params['id'];
        }
        $model['expert_list'] = json_encode($customFieldData['expert_list']);

        $model->save();
    }
}

