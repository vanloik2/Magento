<?php

namespace Product\Content\Block\Adminhtml\BtnForm\Edit;

use Magento\Backend\Block\Widget\Context;
use Product\Content\Model\ProductContentFactory;

class GenericButton
{

    protected $context;
    protected $prctFactory;

    public function __construct(
        Context $context,
        ProductContentFactory $prctFactory
    )
    {
        $this->context = $context;
        $this->prctFactory = $prctFactory;
    }

    public function getProductContentById()
    {
        $id = $this->context->getRequest()->getParam('id');
        $expert = $this->prctFactory->create()->load($id);
        if ($expert->getId())
            return $id;
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
