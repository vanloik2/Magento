<?php
namespace Dev\Banner\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class ChangeBanner implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            '2' => __('Inactive'),
            '3' => __('Top'),
            '4' => __('Bottom'),
        ];
    }
}
