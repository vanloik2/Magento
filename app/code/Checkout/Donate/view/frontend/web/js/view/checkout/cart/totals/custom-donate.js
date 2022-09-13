// Cart totals
define(
    [
        'Checkout_Donate/js/view/checkout/summary/custom-donate'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            /**
             * @override
             */
            isDisplayed: function () {
                return true;
            }
        });
    }
);
