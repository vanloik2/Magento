<?php
namespace Dev\Banner\Block;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Dev\Banner\Model\BannerRepository;
use Dev\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class TopBanner extends Template
{

    protected $bannerRepository;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        BannerRepository $bannerRepository,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bannerRepository = $bannerRepository;
        $this->_collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
    }

    public function getImageChangeBanner(){

        $collection = $this->_collectionFactory->create()->addFieldToSelect('banner_id')->addFieldToFilter('change_banner', 3)->load();

        $array = [];

        foreach ($collection as $value){
            $model = $this->bannerRepository->getById($value['banner_id'])->getData();

            if(empty($model)) {
                $array[] = null;
            }else{
                array_push($array, $model);
            }
        }

        $url = $this->storeManager->getStore()->getBaseUrl(
                UrlInterface::URL_TYPE_MEDIA
            ) . 'dev/tmp/banner/';

        return [$array , $url];

    }
}
