<?php
namespace Checkout\Donate\Block\Adminhtml\SalesOrder;
use Magento\Framework\View\Element\Template;

class CustomDonate extends Template
{

    protected $_config;
    protected $_order;
    protected $_source;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Tax\Model\Config $taxConfig,
        array $data = []
    ) {
        $this->_config = $taxConfig;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        return $this->_order;
    }
    // get data for total order admin
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        if($parent->getOrder()->getData()['custom_donate'] > 0 ) {
            $customDonate = new \Magento\Framework\DataObject(
                [
                    'code' => 'custom_donate',
                    'strong' => false,
                    'value' => $parent->getOrder()->getData()['custom_donate'],
                    'label' => __('Custom Donate'),
                ]
            );
            $parent->addTotal($customDonate, 'custom_donate');
        }
            return $this;
    }
}
