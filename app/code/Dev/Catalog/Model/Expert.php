<?php

namespace Dev\Catalog\Model;

use Magento\Framework\Model\AbstractModel;

class Expert extends AbstractModel
{

    const NAME = 'name';

    protected function _construct()
    {
        $this->_init('Dev\Catalog\Model\ResourceModel\Expert');
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }
}
