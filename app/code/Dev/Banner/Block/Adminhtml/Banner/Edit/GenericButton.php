<?php

namespace Dev\Banner\Block\Adminhtml\Banner\Edit;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{

    protected $context;
    protected $bannerFactory;

    public function __construct(
        Context $context,
        \Dev\Banner\Model\BannerFactory $bannerFactory
    )
    {
        $this->context = $context;
        $this->bannerFactory = $bannerFactory;
    }

    /**
     * Return Banner ID
     */
    public function getBannerId()
    {
        $id = $this->context->getRequest()->getParam('banner_id');
        $banner = $this->bannerFactory->create()->load($id);
        if ($banner->getId())
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
