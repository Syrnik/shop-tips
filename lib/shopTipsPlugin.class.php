<?php
/**
 * Tips plugin for Shop-Script
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @copyright Serge Rodovnichenko, 2015-2023
 * @license MIT
 */

/**
 * Main plugin class
 */
class shopTipsPlugin extends shopPlugin
{
    /**
     * @param $product
     * @return array
     * @throws SmartyException
     * @throws waException
     * @EventHandler backend_product Просмотр товара в админке UI 1.3
     */
    public function hookBackendProduct($product): array
    {
        $result = array();
        $format = $this->getSettings('product_date');
        if (in_array($format, array('date', 'datetime'))) {
            $format = 'human' . $format;
            $result['toolbar_section'] =
                '<div class="small"><table class="zebra bottom-bordered"><tr><td>' . _wp('Created') . ':</td><td style="white-space: nowrap;text-align: right; font-weight: bold">' .
                waDateTime::format($format, strtotime($product['create_datetime'])) .
                '</td></tr>' .
                ($product['edit_datetime'] !== null ? '<tr><td>' . _wp('Updated') . ':</td><td style="white-space: nowrap;text-align: right;font-weight: bold">' . waDateTime::format($format, strtotime($product['edit_datetime'])) . '</td></tr>' : '') .
                '</table></div>';
        }

        if ($this->getSettings('edit_history')) {
            $view = wa()->getView();
            $result['tab_li'] = $view->fetch($this->path . '/templates/hooks/backend_product_tab_li.html');
        }

        return $result;
    }

    /**
     * Просмотр товаров UI 1.3
     *
     * @return void
     * @EventHandler backend_products
     */
    public function hookBackendProducts()
    {
        if ((bool)$this->getSettings('edit_history')) {
            $this->addJs('js/tips.' . (waSystemConfig::isDebug() ? 'js' : 'min.js'));
        }
    }

    /**
     * Returns info about coupon by its ID
     *
     * @param int|string $coupon_id
     * @return array|null
     */
    public static function getCouponById($coupon_id): ?array
    {
        $Coupon = new shopCouponModel();

        return $Coupon->getById($coupon_id);
    }

    /**
     * @param $params
     * @return array|string[]
     * @throws waException
     */
    public function hookBackendOrder($params): array
    {
        $est_delivery = ifset($params, 'params', 'shipping_est_delivery', '');
        if (!$est_delivery) {
            return array();
        }

//        $est_delivery = htmlentities($est_delivery, ENT_QUOTES, 'UTF-8');
        $est_delivery_str = _wp('Estimated delivery date');

        $html = <<<EOT
<script type="text/javascript">
$(function(){ $('p.s-order-address', 'div.s-order').before('<p style="margin-bottom: 0.5em"><span class="gray">$est_delivery_str &mdash;</span> $est_delivery</p>') });
</script>
EOT;
        return array('info_section' => $html);
    }

    /**
     * @param $route
     * @return array|string[]
     */
    public function routing($route = array()): array
    {
        if ($this->getSettings('add2cart')) {
            return array(
                'plugin_tips/to_cart/' => 'cart/add'
            );
        }
        return array();
    }
}
