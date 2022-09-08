<?php

namespace Dev\Banner\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'banner_id';

    protected function _construct()
    {
        $this->_init('Dev\Banner\Model\Banner', 'Dev\Banner\Model\ResourceModel\Banner');
    }
}
