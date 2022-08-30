<?php
namespace Dev\Banner\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Dev\Banner\Model\BannerRepository;
use Dev\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class BottomBanner extends Template
{
    protected $bannerRepository;
    protected $collectionFactory;
    protected $storeManager;

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

        $collection = $this->_collectionFactory->create()->addFieldToSelect('banner_id')->addFieldToFilter('change_banner', 4)->load();

        $url = $this->storeManager->getStore()->getBaseUrl(
                UrlInterface::URL_TYPE_MEDIA
            ) . 'dev/tmp/banner/';

        $array = [];
        foreach ($collection as $value){
            $model = $this->bannerRepository->getById($value['banner_id'])->getData();

            if(empty($model)) {
                $array[] = null;
            }else{
                $model['image'] = $url.$model['image'];
                array_push($array, $model);
            }
        }

        return $array;

    }
}
