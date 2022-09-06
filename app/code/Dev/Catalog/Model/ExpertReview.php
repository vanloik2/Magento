<?php

namespace Dev\Catalog\Model;

use Magento\Framework\Model\AbstractModel;

class ExpertReview extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dev\Catalog\Model\ResourceModel\ExpertReview');
    }
}
