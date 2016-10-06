<?php
/**
 * Tips plugin for Shop-Script 5+
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.1.0
 * @copyright Serge Rodovnichenko, 2015-2016
 * @license MIT
 */

/**
 * Main plugin class
 */
class shopTipsPlugin extends shopPlugin
{
    public function hookBackendProduct($product)
    {
        return array(
            'toolbar_section' =>
                '<div class="small"><table class="zebra" style="border:1px solid powderblue;border-collapse:collapse"><tr><td>Дата создания:</td><td style="white-space: nowrap;text-align: right; font-weight: bold">' .
                waDateTime::format('humandate', strtotime($product['create_datetime'])) .
                '</td></tr>' .
                ($product['edit_datetime'] !== null ? '<tr><td>Изменен</td><td style="white-space: nowrap;text-align: right;font-weight: bold">' . waDateTime::format('humandate', strtotime($product['edit_datetime'])) . '</td></tr>' : '') .
                '</table></div>'
        );
    }

    /**
     * Returns info about coupon by its ID
     *
     * @param int|string $coupon_id
     * @return array|null
     */
    public static function getCouponById($coupon_id)
    {
        $Coupon = new shopCouponModel();

        return $Coupon->getById($coupon_id);
    }

    public function hookBackendOrder($params)
    {
        $est_delivery = ifset($params['params']['shipping_est_delivery']);
        if(!$est_delivery) {
            return array();
        }

//        $est_delivery = htmlentities($est_delivery, ENT_QUOTES, 'UTF-8');

        $html = <<<EOT
<script type="text/javascript">
$(function(){ $('p.s-order-address', 'div.s-order').before('<p style="margin-bottom: 0.5em"><span class="gray">Расчетный срок доставки &mdash;</span> $est_delivery</p>') });
</script>
EOT;
        return array('info_section' => $html);
    }
}
