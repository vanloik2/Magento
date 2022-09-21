<?php

namespace Product\Content\Controller\Adminhtml\Content;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Product\Content\Model\ProductContent;

class Save extends Action implements HttpPostActionInterface
{

    public function __construct(
        Action\Context $context
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }else{
                $data['updated_at'] = date('Y-m-d H:i:s');
            }

            //Customize product sku & product name & product id => json

            if(!empty($data['insert_listing_product'])){

                $infProduct = $data['insert_listing_product'];
                foreach ($infProduct as $item){
                    $data['product_id'] = $item['entity_id'];
                    $data['product_name'] = $item['name'];
                    $data['product_sku'] = $item['sku'];
                }

            }
            $model = $this->_objectManager->create(ProductContent::class);

            $model->setData($data);

            try {

                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Product Content.'));

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the Product Content.'));
            }

        }
        return $resultRedirect->setPath('*/*/');
    }
}
