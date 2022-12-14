<?php

namespace Dev\Catalog\Model\Config;

use Dev\Catalog\Model\ExpertFactory;
use Magento\Framework\Option\ArrayInterface;

class DropdownExpert implements ArrayInterface
{

    protected $expertFactory;

    public function __construct
    (
        ExpertFactory $expertFactory,
    )
    {
        $this->expertFactory = $expertFactory;
    }

    public function toOptionArray()
    {
        $expert = $this->expertFactory->create()->getCollection()->getData();

        if(empty($expert)){
            $option = [];
        }else{
            foreach ($expert as $value){
                $option[] = ['value' => (int)$value['id'], 'label' => $value['name']];
            };
        }

        return $option;
    }
}
