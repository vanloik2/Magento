<?php

namespace Product\Content\Controller\Adminhtml\Content;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Product\Content\Model\ResourceModel\ProductContent\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    protected $filter;
    protected $collectionFactory;

    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $recordDeleted=0;
        foreach ($collection as $item) {
            $deleteItem = $this->_objectManager->get('Product\Content\Model\ProductContent')->load($item->getId());
            $deleteItem->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));

        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
