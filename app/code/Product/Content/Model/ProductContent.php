<?php

namespace Product\Content\Model;

use Magento\Framework\Model\AbstractModel;
use Product\Content\Model\ResourceModel\ProductContent as ResourceModel;

class ProductContent extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'product_content_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
