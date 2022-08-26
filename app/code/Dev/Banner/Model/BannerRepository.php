<?php

namespace Dev\Banner\Model;

use Dev\Banner\Api\Data\BannerInterface;
use Dev\Banner\Model\ResourceModel\Banner\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Class BannerManagement
 * @package Catalog\Banner\Model
 */

class BannerRepository implements \Dev\Banner\Api\BannerRepositoryInterface
{
    /**
     * @var \Dev\Banner\Model\BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var ResourceModel\Banner
     */
    protected $bannerResource;

    /**
     * @var ResourceModel\Banner\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Dev\Banner\Api\Data\BannerSearchResultInterface
     */
    protected $searchResultInterfaceFactory;

    /**
     * BannerRepository constructor.
     * @param \Dev\Banner\Model\BannerFactory $bannerFactory
     * @param ResourceModel\Banner $bannerResource
     * @param ResourceModel\Banner\CollectionFactory $collectionFactory
     * @param \Dev\Banner\Api\Data\BannerSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        \Dev\Banner\Model\BannerFactory $bannerFactory,
        \Dev\Banner\Model\ResourceModel\Banner $bannerResource,
        \Dev\Banner\Model\ResourceModel\Banner\CollectionFactory $collectionFactory,
        \Dev\Banner\Api\Data\BannerSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->bannerResource = $bannerResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $bannerModel = $this->bannerFactory->create();
        $this->bannerResource->load($bannerModel, $id);
        if (!$bannerModel->getBannerId()) {
            throw new NoSuchEntityException(__('Unable to find banner data with ID "%1"', $id));
        }
        return $bannerModel;
    }

    /**
     * {@inheritdoc}
     */
    public function save(BannerInterface $banner)
    {
        $this->bannerResource->save($banner);
        return $banner;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        try {
            $bannerModel = $this->bannerFactory->create();
            $this->bannerResource->load($bannerModel, $id);
            $this->bannerResource->delete($bannerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

}
