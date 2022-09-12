<?php
namespace Checkout\Donate\Block\DonateCheckout;

class InputAttribute
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shippingAdditional']['children']['custom_donate'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'custom-field-text',
            ],
            'dataScope' => 'shippingAddress.custom_attributes.custom_donate',
            'label' => 'Amount Donate',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'sortOrder' => 250,
            /*'customEntry' => null,*/
            'id' => 'custom-field-text',
        ];

        return $jsLayout;
    }
}
