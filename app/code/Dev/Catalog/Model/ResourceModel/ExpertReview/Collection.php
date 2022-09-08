<?php

namespace Dev\Catalog\Model\ResourceModel\ExpertReview;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Dev\Catalog\Model\ExpertReview', 'Dev\Catalog\Model\ResourceModel\ExpertReview');
    }
}
