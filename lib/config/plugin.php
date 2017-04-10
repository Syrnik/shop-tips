<?php
/**
 * Tips plugin for Shop-Script 5+
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.3.0
 * @copyright Serge Rodovnichenko, 2015-2017
 * @license MIT
 */
return array(
    'name'     => _wp('Useful Stuff'),
    'img'      => 'img/tips.png',
    'version'  => '1.3.0',
    'vendor'   => '670917',
    'handlers' =>
        array(
            'backend_product'  => 'hookBackendProduct',
            'backend_products' => 'hookBackendProducts',
            'backend_order'    => 'hookBackendOrder'
        ),
);
