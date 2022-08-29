/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'tests/assets/tools',
    'text!./config.json',
    'text!./ui_component/selector.html',
    'text!./ui_component/virtual.html'
], function (tools, config, selectorTmpl, virtualTmpl) {
    'use strict';

    return tools.init(config, {
        bySelector: selectorTmpl,
        virtual: virtualTmpl
    });
});
