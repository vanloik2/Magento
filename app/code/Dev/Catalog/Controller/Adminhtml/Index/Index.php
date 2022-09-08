<?php

namespace Dev\Catalog\Controller\Adminhtml\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Dev_Catalog::expert';

    protected $_pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Expert Listing'));
        return $resultPage;
    }
}
