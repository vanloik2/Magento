/*jshint browser:true jquery:true*/
/*global alert*/
// File handle totals
define(
    [
        'jquery',
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals',
        'mage/url',
        'Magento_Checkout/js/action/get-totals'
    ],
    function ($ ,Component, quote, priceUtils, totals, urlBuilder, getTotalsAction) {
        "use strict";
        const URL_CONTROLLER_HANDLE = 'checkout/donate/removecustomdonate';
        return Component.extend({
            defaults: {
                isFullTaxSummaryDisplayed: window.checkoutConfig.isFullTaxSummaryDisplayed || false,
                template: 'Checkout_Donate/checkout/summary/customDonate'
            },
            totals: quote.getTotals(),
            isTaxDisplayedInGrandTotal: window.checkoutConfig.includeTaxInGrandTotal || false,
            isDisplayed: function() {
                return this.isFullMode();
            },
            getValue: function() {
                var price = 0;
                if (this.totals()) {
                    price = totals.getSegment('custom_donate').value;
                }
                return this.getFormattedPrice(price);
            },
            getBaseValue: function() {
                var price = 0;
                if (this.totals()) {
                    price = this.totals();
                }
                return priceUtils.formatPrice(price, quote.getBasePriceFormat());
            },
            getParamUrl: function (){
                var configValues = window.checkoutConfig;
                return configValues.quoteItemData[0]['quote_id'];
            },
            removeCustomDonate: function () {
                var url = urlBuilder.build(URL_CONTROLLER_HANDLE)
                $.ajax({
                    url: url + '/id/' + this.getParamUrl(),
                    type: 'POST',
                    data: {},
                    showLoader: true,
                    success: function (res) {
                        var deferred = $.Deferred();
                        getTotalsAction([], deferred);
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    }
                });
            }
        });
    }
);

