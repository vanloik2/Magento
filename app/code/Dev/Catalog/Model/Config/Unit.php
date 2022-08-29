<?php

namespace Dev\Catalog\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class Unit implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Div 1')],
            ['value' => 2, 'label' => __('Div 2')],
            ['value' => 3, 'label' => __('Div 3')],
            ['value' => 4, 'label' => __('Div 4')],
        ];
    }
}
