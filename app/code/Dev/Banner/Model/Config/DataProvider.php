<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dev\Banner\Model\Config;

use Dev\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \Dev\Banner\Model\ResourceModel\Banner\Collection
     */
    protected $collection;
    protected  $storeManager;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        StoreManagerInterface $storeManager,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Dev\Banner\Model\Banner $banner */
        foreach ($items as $banner) {

            $data = $banner->getData();
            $image = $data['image'];

            $data['images'][0]['url'] = $this->storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ) . 'dev/tmp/banner/' . $image;

            $data['images'][0]['name'] = $image;

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
