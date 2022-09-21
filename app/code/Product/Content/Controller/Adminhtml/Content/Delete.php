<?php

namespace Product\Content\Controller\Adminhtml\Content;

class Delete extends \Magento\Backend\App\Action
{

    public function execute()
    {
        // Get ID of record by param
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // Init model and delete
                $model = $this->_objectManager->create('Product\Content\Model\ProductContent');
                $model->load($id);
                $id = $model->getId();
                $model->delete();

                // Display success message
                $this->messageManager->addSuccess(__('The record has been deleted.'));

                // Redirect to list page
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // Display error message
                $this->messageManager->addError($e->getMessage());
                // Go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        // Display error message
        $this->messageManager->addError(__('We can\'t find a product content to delete.'));

        // Redirect to list page
        return $resultRedirect->setPath('*/*/');
    }
}
