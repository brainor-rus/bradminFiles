<?php

namespace Bradmin\Plugins\BRCommerce\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('bradmin.admin_url').'/BRCommerce',
                'icon' => 'fas fa-users',
                'text' => 'BRCommerce',
                'nodes' => [
                    [
                        'url' => '/bradmin/BRCommerce/BROffers',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'Т',
                        'text' => 'Товары'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self)->pluginNav;
    }

}