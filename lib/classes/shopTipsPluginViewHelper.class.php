<?php
/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @copyright Serge Rodovnichenko, 2023
 * @license MIT
 */

declare(strict_types=1);

/**
 * Хелпер плагина. Работает в Shop-Script 8.18+ и Webasyst Framework 2.0+
 */
class shopTipsPluginViewHelper extends waPluginViewHelper
{
    /**
     * Купон по его id
     *
     * @param int|string $coupon_id ID купона
     * @return array
     */
    public function getCouponById($coupon_id): array
    {
        return shopTipsPlugin::getCouponById($coupon_id);
    }

    /**
     * Генератор события для встраивания перед закрывающим тегом body
     * @return array
     */
    public function footer_js(): array
    {
        $params = [];
        try {
            $result = wa('shop')->event(['shop', 'tips_plugin_footer_js'], $params, ['links', 'inline_js', 'inline_css']) ?: [];
            if (!is_array($result)) return [];

            $response = ['links' => [], 'inline_js' => [], 'inline_css' => []];

            foreach ($result as $plugin_id => $plugin_result) {
                $links = (array)($plugin_result['links'] ?? []);
                array_walk($links, function (&$link) {
                    if (is_string($link)) {
                        $link = ['uri' => $link, 'type' => 'js', 'async' => false, 'defer' => false, 'id' => uniqid('footer-link-')];
                    } elseif (!is_array($link)) {
                        $link = ['uri' => false];
                    } else {
                        $link += ['uri' => false, 'type' => 'js', 'async' => false, 'defer' => false, 'id' => uniqid('footer-link-')];
                    }
                });
                $plugin_result['links'] = array_filter($links, function ($link) {
                    return !!($link['uri'] ?? false);
                });

                if ($plugin_result['links']) {
                    $response['links'][$plugin_id] = array_map(function ($link) {
                        return "<script id=\"{$link['id']}\" src=\"{$link['uri']}\"" . ($link['defer'] ? ' defer' : '') . ($link['async'] ? ' async' : '') . "></script>";
                    }, $plugin_result['links']);
                }
                if(isset($plugin_result['inline_js']) && is_string($plugin_result['inline_js']))
                    $response['inline_js'][$plugin_id]=$plugin_result['inline_js'];

                if(isset($plugin_result['inline_css']) && is_string($plugin_result['inline_css']))
                    $response['inline_css'][$plugin_id]=$plugin_result['inline_css'];
            }

            return $response;
        } catch (waException $e) {
            return [];
        }
    }
}
