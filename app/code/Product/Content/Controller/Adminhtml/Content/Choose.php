<?php

namespace Product\Content\Controller\Adminhtml\Content;

use Magento\Backend\App\Action;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;

class Choose extends Action
{

    protected $_resultFactory;

    public function __construct(Action\Context $context, resultFactory $resultFactory, RequestInterface $request)
    {
        $this->_request = $request;
        $this->_resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $productId = $this->_request->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        $resultRedirect->setPath('product/content/edit/'. 'product_id/'. $productId);
        return $resultRedirect;
    }
}
