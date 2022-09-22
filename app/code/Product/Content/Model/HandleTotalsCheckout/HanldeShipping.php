<?php
namespace Product\Content\Model\HandleTotalsCheckout;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote\Address\Total;


class HanldeShipping extends AbstractTotal
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

            $feeShip = 0 ;
            $total->setTotalAmount($this->getCode(), $feeShip);
            $total->setBaseTotalAmount($this->getCode(), $feeShip);

        return $this;
    }

    // get value use for templates
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
