<?php

namespace Dev\Banner\Model;

class Banner extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dev\Banner\Model\ResourceModel\Banner');
    }
}
