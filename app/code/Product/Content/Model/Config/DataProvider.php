<?php
namespace Product\Content\Model\Config;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Request\DataPersistorInterface;
use Product\Content\Model\ResourceModel\ProductContent\CollectionFactory;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
/**
 * Class DataProvider
 */
class DataProvider extends ModifierPoolDataProvider
{

    protected $collection;
    protected $loadedData;
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $blockCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->collection = $blockCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }


    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $proct) {

            $data = $proct->getData();

            //Change data info product -> original data

            $this->loadedData[$proct->getId()] = $data;
        }

        $data = $this->dataPersistor->get('product_content');
        if (!empty($data)) {
            $proct = $this->collection->getNewEmptyItem();
            $proct->setData($data);
            $this->loadedData[$proct->getId()] = $proct->getData();
            $this->dataPersistor->clear('product_content');
        }
//        dd($this->loadedData);
        return $this->loadedData;
    }

}
