<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dev\Banner\Model\Config;

use Dev\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\UrlInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Json\Helper\Data;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    protected $collection;
    protected $storeManager;
    protected $dataPersistor;
    protected $loadedData;
    protected $jsonHelper;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        StoreManagerInterface $storeManager,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        Data $jsonHelper,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $banner) {

            $data = $banner->getData();

            // convert image về định dạng edit

            $data['images'] = [
                0 => [
                    'url' => $this->storeManager->getStore()->getBaseUrl(UrlInterFace::URL_TYPE_MEDIA) . 'dev/tmp/banner/' . $data['image'],
                    'name' => $data['image']
                ]
            ];

            // Biến đổi về mảng khi save // size -> dynamic_row

            if(empty($data['size']) === false){
                $data['dynamic_row'] = $this->jsonHelper->jsonDecode($data['size']);
            }

            //test_listing_insert

//            $insert_listing = $data['test_insert_listing'];
//            if(isset($insert_listing)){
//                $data['insert_listing_example'] = $this->jsonHelper->jsonDecode($insert_listing);
//            }

            $this->loadedData[$banner->getId()] = $data;
        }

        $data = $this->dataPersistor->get('banner');

        if (!empty($data)) {
            $banner = $this->collection->getNewEmptyItem();
            $banner->setData($data);
            $this->loadedData[$banner->getId()] = $banner->getData();
            $this->dataPersistor->clear('banner');
        }

        return $this->loadedData;
    }
}
