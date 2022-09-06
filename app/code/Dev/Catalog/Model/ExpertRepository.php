<?php

namespace Dev\Catalog\Model;

use Dev\Catalog\Api\Data\ExpertInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Dev\Catalog\Api\ExpertRepositoryInterface;

class ExpertRepository implements ExpertRepositoryInterface
{

    protected $expertFactory;
    protected $expertResource;
    protected $collectionFactory;
    protected $searchResultInterfaceFactory;

    public function __construct(
        \Dev\Catalog\Model\ExpertFactory $expertFactory,
        \Dev\Catalog\Model\ResourceModel\Expert $expertResource,
        \Dev\Catalog\Model\ResourceModel\Expert\CollectionFactory $collectionFactory,
        \Dev\Catalog\Api\Data\ExpertSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->expertFactory = $expertFactory;
        $this->expertResource = $expertResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $expertModel = $this->expertFactory->create();
        $this->expertResource->load($expertModel, $id);
        if (!$expertModel->getEntityId()) {
            throw new NoSuchEntityException(__('Unable to find expert data with ID "%1"', $id));
        }
        return $expertModel;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ExpertInterface $expert)
    {
        $this->expertResource->save($expert);
        return $expert;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        try {
            $expertModel = $this->expertFactory->create();
            $this->expertResource->load($expertModel, $id);
            $this->expertResource->delete($expertModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

}
