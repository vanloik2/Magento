<?php

namespace Dev\Banner\Block\Adminhtml\Banner\Helper;

use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute;
use Magento\Catalog\Api\Data\ProductInterface;

class Form extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery
{
    /**
     * @var here you set your ui form
     */
    protected $formName = 'test_form';
}

