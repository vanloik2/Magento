<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dev\Catalog\Model\Config;

use Dev\Catalog\Model\ResourceModel\Expert\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
/**
 * Class DataProvider
 */
class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var \Dev\Catalog\Model\ResourceModel\Expert\Collection
     */
    protected $collection;

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
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
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
        /** @var \Dev\Catalog\Model\Expert $expert */
        foreach ($items as $expert) {

            $data = $expert->getData();

            $this->loadedData[$expert->getId()] = $data;
        }

        $data = $this->dataPersistor->get('expert');
        if (!empty($data)) {
            $expert = $this->collection->getNewEmptyItem();
            $expert->setData($data);
            $this->loadedData[$expert->getId()] = $expert->getData();
            $this->dataPersistor->clear('expert');
        }

        return $this->loadedData;
    }
}
