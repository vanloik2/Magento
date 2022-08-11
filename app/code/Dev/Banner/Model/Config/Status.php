<?php

namespace Dev\Banner\Model\Config;

/**
 * Class Status
 * @package ViMagento\HelloWorld\Model\Config
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Hết hàng')],
            ['value' => 2, 'label' => __('Còn hàng')],
        ];
    }
}
