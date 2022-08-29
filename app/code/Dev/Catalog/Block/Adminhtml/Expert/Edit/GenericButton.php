<?php

namespace Dev\Catalog\Block\Adminhtml\Expert\Edit;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{

    protected $context;
    protected $expertFactory;

    public function __construct(
        Context $context,
        \Dev\Catalog\Model\ExpertFactory $expertFactory
    )
    {
        $this->context = $context;
        $this->expertFactory = $expertFactory;
    }

    /**
     * Return Banner ID
     */
    public function getExpertId()
    {
        $id = $this->context->getRequest()->getParam('id');
        $expert = $this->expertFactory->create()->load($id);
        if ($expert->getId())
            return $id;
        return null;
    }

    /**
     * Generate url by route and parameters
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
