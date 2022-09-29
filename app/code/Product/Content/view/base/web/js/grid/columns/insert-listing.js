define([
    'Magento_Ui/js/grid/columns/multiselect',
    'underscore'
], function (Select, _) {
    'use strict';

    return Select.extend({
        defaults: {
            headerTmpl: 'ui/grid/columns/text',
            bodyTmpl: 'Product_Content/grid/cells/insert-listing',
            label: '',
            extendedSelections: [],
            lastSelected: null,
            listens: {
                selected: 'onSelectedChange setExtendedSelections'
            }
        },

        initObservable: function () {
            this._super()
                .observe('extendedSelections lastSelected');

            return this;
        },

        select: function (id) {
            this._super();
            this.lastSelected(id);
            console.log(id)
            return this;
        },

        _setSelection: function (id, isIndex, select) {
            var selected = this.selected;

            id = this.getId(id, isIndex);
            if (!select && this.isSelected(id)) {
                selected([]);
            } else if (select) {
                selected([id]);
            }
            return this;
        }
    });
});
