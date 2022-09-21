<?php

namespace Product\Content\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class DisplayArea implements ArrayInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => 0, 'label' => __('Content Top')],
            ['value' => 1, 'label' => __('Content Bottom')],
        ];
    }
}
