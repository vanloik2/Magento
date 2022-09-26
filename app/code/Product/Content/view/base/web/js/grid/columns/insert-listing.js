define([
    'underscore',
    'mageUtils',
    'uiRegistry',
    'Magento_Ui/js/grid/columns/column',
    'Magento_Ui/js/modal/confirm',
    'mage/dataPost',
    'jquery'
], function (_, utils, registry, Column, confirm, dataPost, $) {
    'use strict';
    return Column.extend({
        defaults: {
            bodyTmpl: 'Product_Content/grid/cells/insert-listing',
        },
        Btn: function (){
            return 'Choose'
        },
        HelloWorld: function (){
            alert('abc')
            alert(dataPost.valueOf())
        }
    });
});
