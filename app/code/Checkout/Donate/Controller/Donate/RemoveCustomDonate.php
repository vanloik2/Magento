<?php

namespace Checkout\Donate\Controller\Donate;

use Magento\Checkout\Model\Session;
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
    /**
     * @var Session
     */
    private $session;

    public function __construct(
        Context $context,
        RequestInterface $request,
        QuoteRepository $quoteRepository,
        Session $session
    )
    {
        $this->_request = $request;
        $this->quoteRepository = $quoteRepository;
        $this->session = $session;
        parent::__construct($context);
    }

    /**
     * @throws NoSuchEntityException
     */
    public function execute()
    {
//        $quoteId = $this->_request->getParam('id');
        $quoteId = $this->getQuoteId();
        $quote = $this->quoteRepository->getActive($quoteId);
        $quote['custom_donate'] = 0;
        $this->quoteRepository->save($quote);
    }

    public function getQuoteId(): int
    {
        return $this->session->getQuoteId();
    }
}
