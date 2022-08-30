<?php

namespace Dev\Catalog\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class Position implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Fresher')],
            ['value' => 1, 'label' => __('Developer')],
            ['value' => 2, 'label' => __('Leader')],
            ['value' => 3, 'label' => __('Manager')],
        ];
    }
}
