"use strict";

module.exports = {
    runTab: function () {
        $('.tab-content', '#s-product-profile-tabs')
            .append('<div class="block s-tab-block" data-tab="tipslog" id="s-plugin-tipslog-tab"></div>');
        $('#s-product-profile-tabs').on('open', '.s-tab-block[data-tab="tipslog"]', function () {
            if (!$(this).data('loaded'))
                $(this).load('?plugin=tips&module=product&action=log&product_id=' + $.product.getId(), function () {

                }).data('loaded', 1)
        });
    }
};
