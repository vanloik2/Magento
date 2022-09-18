<?php

namespace Checkout\Donate\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class CustomDonateConfigProvider implements ConfigProviderInterface
{

    public function getConfig() : array
    {
        return [];
    }

}
