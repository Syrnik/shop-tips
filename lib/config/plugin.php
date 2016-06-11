<?php
/**
 * Tips plugin for Shop-Script 5+
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.1.0
 * @copyright Serge Rodovnichenko, 2015-2016
 * @license MIT
 */
return array(
    'name'     => 'Полезные мелочи',
    'img'     => 'img/tips.png',
    'version'  => '1.1.0',
    'vendor'   => '670917',
    'handlers' =>
        array(
            'backend_product' => 'hookBackendProduct'
        ),
);
