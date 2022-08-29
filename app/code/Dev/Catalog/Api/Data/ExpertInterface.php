<?php

namespace Dev\Catalog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface ExpertInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getExpertId();

    /**
     * @param int $id
     * @return $this
     */
    public function setExpertId($id);

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
    public function getPosition();

    /**
     * @param string $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * @return int
     */
    public function getUnit();

    /**
     * @param int $unit
     * @return $this
     */
    public function setUnit($unit);

}
