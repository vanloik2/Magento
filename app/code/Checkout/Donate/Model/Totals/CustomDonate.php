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

    // Hàm tính toán giá trị custom donate-validator.js
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    ){
        parent::collect($quote, $shippingAssignment, $total);

        $customDonate = $quote['custom_donate'];
        $balance = $customDonate ;
        $total->setTotalAmount($this->getCode(), $balance);
        $total->setBaseTotalAmount($this->getCode(), $balance);

        return $this;
    }

    // Hàm lấy ra giá trị và return về mảng ...
    public function fetch(Quote $quote, Total $total)
    {
        return [
            'code'=> $this->getCode(),
            'title'=>'Custom Donate',
            'value'=> $quote['custom_donate']
        ];
    }

    public function getLabel()
    {
        return __('Custom Donate');
    }
}
