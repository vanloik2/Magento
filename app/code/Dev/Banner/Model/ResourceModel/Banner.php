<?php

namespace Dev\Banner\Model\ResourceModel;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('banner', 'banner_id');
    }
}
