<?php

namespace Product\Content\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class FreeShipping extends AbstractSource
{

    public function getAllOptions(): ?array
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('--Select--'), 'value' => ''],
                ['label' => __('Free'), 'value' => 1],
            ];
        }
        return $this->_options;
    }
}
