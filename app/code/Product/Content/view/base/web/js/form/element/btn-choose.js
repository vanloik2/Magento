/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'uiLayout',
    'uiElement',
    'Magento_PageBuilder/js/config',
    'mage/translate',
    'mage/utils/objects'
], function ($, layout, Element, Config, $t, objectUtils) {
    'use strict';

    return Element.extend({
        id: null,
        meta: {},
        errorMessage: null,
        displayMetadata: true,
        defaults: {
            template: 'Product_Content/form/element/btn-chooser',
            requestParameter: null,
            dataUrlConfigPath: null,
            modalName: null,
            buttonComponentConfig: {
                title: '${ $.buttonTitle }',
                component: 'Magento_Ui/js/form/components/button',
                actions: [{
                    targetName: '${ $.modalName }',
                    actionName: 'openModal'
                }]
            },
            requestData: {
                method: 'POST',
                data: {
                    'form_key': window.FORM_KEY
                }
            },
            listens: {
                id: 'updateFromServer'
            }
        },

        initObservable: function () {
            return this._super()
                .observe('id meta errorMessage displayMetadata');
        },

        getButton: function () {
            var elementConfig = this.buttonComponentConfig;

            elementConfig.name = this.name + '_button';
            layout([elementConfig]);

            return this.requestModule(elementConfig.name);
        },

    });
});
