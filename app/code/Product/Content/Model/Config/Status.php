<?php
namespace Product\Content\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => 1, 'label' => __('Enabled')],
            ['value' => 2, 'label' => __('Disabled')],
        ];
    }
}
