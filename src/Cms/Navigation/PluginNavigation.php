<?php

namespace Bradmin\Cms\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('bradmin.admin_url').'/cms/brpages',
                'icon' => 'fas fa-users',
                'text' => 'Страницы'
            ],
            [
                'url' => '/'.config('bradmin.admin_url').'/cms/brposts',
                'icon' => 'fas fa-address-book',
                'text' => 'Записи'
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self())->pluginNav;
    }

}