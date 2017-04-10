<?php
/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.3.0
 * @copyright Serge Rodovnichenko, 2017
 * @license MIT
 */
return array(
    'product_date' => array(
        'title'        => 'Даты товара',
        'description'  => 'Показывать даты создания и редактирования товара',
        'control_type' => waHtmlControl::SELECT,
        'value'        => 'date',
        'options'      => array('no' => 'не показывать', 'date' => 'дату', 'datetime' => 'дату и время')
    ),
    'edit_history' => array(
        'title'        => _wp('Edit history'),
        'description'  => _wp('Show a product editing history in the separate tab at product view page in backend'),
        'control_type' => waHtmlControl::CHECKBOX,
        'value'        => '0'
    )
);
