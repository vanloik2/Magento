<?php

namespace Dev\Catalog\Api;

use Dev\Catalog\Api\Data\ExpertInterface;

/**
 * Interface CustomManagementInterface
 * @package Catalog\Expert\Api
 */
interface ExpertRepositoryInterface
{
    /**
     * @param int $id
     * @return \Dev\Catalog\Api\Data\ExpertInterface
     */
    public function getById($id);

    /**
     * @param \Dev\Catalog\Api\Data\ExpertInterface $expert
     * @return \Dev\Catalog\Api\Data\ExpertInterface
     */
    public function save(ExpertInterface $expert);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

}
