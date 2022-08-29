<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dev\Catalog\Controller\Adminhtml\Index;

use Dev\Catalog\Model\ExpertFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dev_Catalog::save';


    protected $jsonFactory;
    protected $expertFactory;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        ExpertFactory $expertFactory,
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->expertFactory = $expertFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       $resultJson = $this->jsonFactory->create();
       $error = false;
       $messages = [];

       $postItems  = $this->getRequest()->getParam('items', []);

       foreach (array_keys($postItems) as $expertId) {
           try{
               $banner = $this->expertFactory->create();
               $banner->load($expertId);
               $banner->setData($postItems[$expertId]);
               $banner->save();
           }
           catch(\Exception $e){
               $messages[] = __('Error while saving banner');
               $error = true;
           }

           return $resultJson->setData([
               'messages' => $messages,
               'error' => $error
           ]);
       }

    }
}
