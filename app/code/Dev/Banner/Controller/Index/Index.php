<?php

namespace Dev\Banner\Controller\Index;

use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $bannerRepository;
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Dev\Banner\Model\BannerRepository $bannerRepository,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        $this->bannerRepository = $bannerRepository;
        return parent::__construct($context);
    }

    public function execute()
    {
//        $data = $this->bannerFactory->create()->getCollection();
//        foreach ($data as $value) {
//            echo "<pre>";
//            print_r($value->getData());
//            echo "</pre>";
//        }

//        $id = $this->getRequest()->getParam('id');
//
//        $model = $this->bannerRepository->getById($id);



        return $this->pageFactory->create();
    }
}
