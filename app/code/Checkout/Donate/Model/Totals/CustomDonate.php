<?php
namespace Checkout\Donate\Model\Totals;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote\Address\Total;


class CustomDonate extends AbstractTotal
{

    protected $quoteValidator = null;
    protected $quote;
    protected $shippingAssignment;
    protected $total;
    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator)
    {
        $this->quoteValidator = $quoteValidator;
    }

    // add value of custom donate to totals
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    )
    {
        parent::collect($quote, $shippingAssignment, $total);

            $balance = $quote['custom_donate'] ;
            $total->setTotalAmount($this->getCode(), $balance);
            $total->setBaseTotalAmount($this->getCode(), $balance);

            return $this;
    }

    // get value use for template
    public function fetch(Quote $quote, Total $total): array
    {
        return[
            'code'=> $this->getCode(),
            'title'=>'Custom Donate',
            'value'=> $quote['custom_donate'],
            'quote_id' => $this->getQuoteId($quote)
        ];
    }

    public function getLabel()
    {
        return __('Custom Donate');
    }

    private function getQuoteId(Quote $quote)
    {
        return $quote->getEntityId();
    }

}
