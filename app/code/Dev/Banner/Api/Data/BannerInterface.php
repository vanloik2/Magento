<?php

namespace Dev\Banner\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface CustomInterface
 * @package Catalog\Banner\Api\Data
 */
interface BannerInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getBannerId();

    /**
     * @param int $id
     * @return $this
     */
    public function setBannerId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param string $image
     * @return $this
     */
    public function setImage($image);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getShortDescription();

    /**
     * @param string $short_description
     * @return $this
     */
    public function setShortDescription($short_description);
}
