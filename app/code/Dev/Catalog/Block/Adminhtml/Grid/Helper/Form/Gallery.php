<?php

namespace Dev\Catalog\Block\Adminhtml\Grid\Helper\Form;

use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute;
use Magento\Catalog\Api\Data\ProductInterface;

class Gallery extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery
{
    /**
     * @var string
     */
    protected $formName = 'sample_form';

}
