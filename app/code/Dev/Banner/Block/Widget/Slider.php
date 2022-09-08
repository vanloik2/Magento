<?php
namespace Dev\Banner\Block\Widget;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Slider extends \Magento\Framework\View\Element\Template
{
    protected $_bannerFactory;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dev\Banner\Model\BannerFactory $bannerFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_bannerFactory = $bannerFactory;
        parent::__construct($context, $data);
    }

    public function getBanners()
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'dev/tmp/banner/';

        $arr = $this->_bannerFactory->create()
            ->getCollection()
            ->setOrder('banner_id', 'DESC')
            ->setPageSize(30)
            ->setCurPage(1);

        $bannerImages = [];
        foreach ($arr as $item){
            array_push($bannerImages, $mediaUrl . $item['image']);
        }

        return $bannerImages;
    }
}
