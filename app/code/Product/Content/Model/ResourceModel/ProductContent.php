<?php

namespace Product\Content\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductContent extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'product_content_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('product_content', 'id');
        $this->_useIsObjectNew = true;
    }
}
