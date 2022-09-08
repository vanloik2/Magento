<?php

namespace Dev\Catalog\Api\Data;

/**
 * Interface ExpertSearchResultInterface
 * @package Catalog\Catalog\Api\Data
 */
interface ExpertSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Dev\Catalog\Api\Data\ExpertInterface[]
     */
    public function getItems();

    /**
     * @param \Dev\Catalog\Api\Data\ExpertInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
