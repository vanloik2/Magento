<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dev\Banner\Controller\Adminhtml\Index;

use Dev\Banner\Model\BannerFactory;
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
    const ADMIN_RESOURCE = 'Dev_Banner::save';


    protected $jsonFactory;
    protected $bannerFactory;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        BannerFactory $bannerFactory,
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       $resultJson = $this->jsonFactory->create();
       $error = false;
       $messages = [];

       $postItems  = $this->getRequest()->getParam('items', []);

       foreach (array_keys($postItems) as $bannerId) {
           try{
               $banner = $this->bannerFactory->create();
               $banner->load($bannerId);
               $banner->setData($postItems[$bannerId]);
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
