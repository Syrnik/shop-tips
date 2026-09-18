<?php
/**
 * Tips plugin for Shop-Script 5+
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 2.0.1
 * @copyright Serge Rodovnichenko, 2015-2026
 * @license MIT
 */
return array(
    'name'     => /*_wp*/('Useful Stuff'),
    'img'      => 'img/tips.png',
    'version'  => '2.0.1',
    'vendor'   => '670917',
    'handlers' =>
        array(
            'backend_product'  => 'hookBackendProduct',
            'backend_products' => 'hookBackendProducts',
            'backend_order'    => 'hookBackendOrder'
        ),
);
