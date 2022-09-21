<?php

namespace Product\Content\Model\ResourceModel\ProductContent;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Product\Content\Model\ProductContent as Model;
use Product\Content\Model\ResourceModel\ProductContent as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'product_content_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
