<?php

namespace Bradmin\Plugins\BRCommerce\Sections;

use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Display\Table\DisplayTable;

class BROffers extends Section
{
    public static function onDisplay(){

        $display = Display::table([
            Column::text('id', '#'),
        ])->setPagination(2);

        return $display;
    }
}