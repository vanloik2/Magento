<?php

namespace Dev\Catalog\Controller\Adminhtml\Image;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Dev\Catalog\Model\Upload\ImageUploader;

class Upload extends \Magento\Backend\App\Action
{
    public $imageUploader;

    public function __construct(
        Context       $context,
        ImageUploader $imageUploader
    )
    {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Dev_Catalog::review');
    }

    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('image_review');
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'error_code' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
