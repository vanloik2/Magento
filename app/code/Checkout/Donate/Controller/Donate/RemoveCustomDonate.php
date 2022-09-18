<?php

namespace Checkout\Donate\Controller\Donate;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\RequestInterface;
use Magento\Quote\Model\QuoteRepository;

class RemoveCustomDonate  extends Action
{

    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    public function __construct(
        Context $context,
        RequestInterface $request,
        QuoteRepository $quoteRepository
    )
    {
        $this->_request = $request;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($context);
    }

    /**
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $quoteId = $this->_request->getParam('id');
        $quote = $this->quoteRepository->getActive($quoteId);
        $quote['custom_donate'] = 0;
        $this->quoteRepository->save($quote);
    }
}
