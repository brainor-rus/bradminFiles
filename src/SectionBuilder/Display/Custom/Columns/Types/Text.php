<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.10.2018
 * Time: 13:10
 */

namespace Bradmin\SectionBuilder\Display\Custom\Columns\Types;

use Bradmin\SectionBuilder\Display\Custom\Columns\Types\BaseType\Type;

class Text extends Type
{
    public function render($value)
    {
        return $value;
    }
}