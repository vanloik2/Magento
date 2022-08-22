<?php

namespace Dev\Banner\Ui\Component\Banner\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Date extends Column {

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource) {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as $r => $v) {
                if(strtotime($v['created_at']) < 0){
                    $dataSource['data']['items'][$r]['date'] = "-----";
                } else{
                    $dataSource['data']['items'][$r]['created_at'] = date('Y-MM-dd HH:mm:ss', strtotime($v['created_at']));
                }
            }
        }

        return $dataSource;
    }
}
