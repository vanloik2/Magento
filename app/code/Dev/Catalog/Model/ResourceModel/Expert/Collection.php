<?php

namespace Dev\Catalog\Model\ResourceModel\Expert;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Dev\Catalog\Model\Expert', 'Dev\Catalog\Model\ResourceModel\Expert');
    }
}
