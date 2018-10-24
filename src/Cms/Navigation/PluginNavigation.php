<?php

namespace Bradmin\Cms\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('bradmin.admin_url').'/cms',
                'icon' => 'fas fa-users',
                'text' => 'CMS',
                'nodes' => [
                    [
                        'url' => '/'.config('bradmin.admin_url').'/cms/brpages',
                        'icon' => 'fas fa-users',
                        'text' => 'Страницы'
                    ],
                    [
                        'url' => '/'.config('bradmin.admin_url').'/cms/brposts',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Записи'
                    ],
                    [
                        'url' => '/'.config('bradmin.admin_url').'/cms/brterms',
                        'icon' => 'fas fa-users',
                        'text' => 'Рубрики'
                    ],
                    [
                        'url' => '/'.config('bradmin.admin_url').'/cms/brtags',
                        'icon' => 'fas fa-address-book',
                        'text' => 'Метки'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self())->pluginNav;
    }

}