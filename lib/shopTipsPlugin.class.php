<?php

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
}
