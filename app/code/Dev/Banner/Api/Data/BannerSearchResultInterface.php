<?php

namespace Dev\Banner\Api\Data;

/**
 * Interface BannerSearchResultInterface
 * @package Catalog\Banner\Api\Data
 */
interface BannerSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Dev\Banner\Api\Data\BannerInterface[]
     */
    public function getItems();

    /**
     * @param \Dev\Banner\Api\Data\BannerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
