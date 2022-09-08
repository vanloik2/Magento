<?php

namespace Dev\Catalog\Controller\Review;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;

class Index extends Action
{
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
