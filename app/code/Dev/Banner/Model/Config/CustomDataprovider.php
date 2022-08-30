<?php

namespace Dev\Banner\Model\Config;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

/**
 * Class CustomDataProvider
 */
class CustomDataprovider extends DataProvider
{
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return [
            'items' => [
                [
                    'id' => 1,
                    'name' => 'First Item'
                ],
                [
                    'id' => 2,
                    'name' => 'Second Item'
                ],
                [
                    'id' => 3,
                    'name' => 'Third Item'
                ]
            ],
            'totalRecords' => 3
        ];
    }
}
