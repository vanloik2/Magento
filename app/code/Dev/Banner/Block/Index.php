<?php
namespace Dev\Banner\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Dev\Banner\Model\BannerFactory;

class Index extends Template
{

    protected $bannerFactory;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        BannerFactory $bannerFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bannerFactory = $bannerFactory;
    }

    public function sayHello(){
        return 'Hello_world';
    }

    public function getDataBanner(){

        return $this->bannerFactory->create()->getCollection();

    }
}
