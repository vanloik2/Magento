<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Product\Content\Controller\Adminhtml\Content;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Product\Content\Model\ProductContent;

class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{

    protected $_coreRegistry;
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Product_Content::index');
        return $resultPage;
    }

    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(ProductContent::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('product_content', $model);

        // 5. Build edit form

        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('Create Product Content'));

        return $resultPage;
    }
}
