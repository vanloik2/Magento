<?php

namespace Dev\Catalog\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class Position implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Option 1')],
            ['value' => 1, 'label' => __('Option 2')],
            ['value' => 2, 'label' => __('Option 3')],
            ['value' => 3, 'label' => __('Option 4')],
        ];
    }
}
