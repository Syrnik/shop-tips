<?php
/**
 * Update file for Tips plugin
 *
 * Removes the leftover 'add2cart' setting value: the Yandex.Turbo
 * cart-add URL feature it controlled has been removed (Yandex
 * discontinued the Turbo cart integration it was built for), so the
 * setting no longer has a corresponding control on the settings screen.
 *
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @copyright Serge Rodovnichenko, 2026
 * @license MIT
 */

$settings_model = new waAppSettingsModel();
$settings_model->del(array('shop', 'tips'), 'add2cart');
