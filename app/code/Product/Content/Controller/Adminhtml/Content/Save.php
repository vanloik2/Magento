<?php

namespace Product\Content\Controller\Adminhtml\Content;

use Magento\Backend\App\Action;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ObjectManager;
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
            // Set info product for data
            $objectManager = ObjectManager::getInstance();
            $product = $objectManager->create(Product::class)->load($data['entity_id']);

            $data['product_name'] = $product->getName();
            $data['product_sku'] = $product->getSku();

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
