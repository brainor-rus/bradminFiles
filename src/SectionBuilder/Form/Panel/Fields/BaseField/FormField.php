<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 14:21
 */

namespace Bradmin\SectionBuilder\Form\Panel\Fields\BaseField;


use Bradmin\SectionBuilder\Form\Panel\Fields\Custom;
use Bradmin\SectionBuilder\Form\Panel\Fields\Hidden;
use Bradmin\SectionBuilder\Form\Panel\Fields\Input;
use Bradmin\SectionBuilder\Form\Panel\Fields\MultiSelect;
use Bradmin\SectionBuilder\Form\Panel\Fields\Select;
use Bradmin\SectionBuilder\Form\Panel\Fields\Textarea;
use Bradmin\SectionBuilder\Form\Panel\Fields\Wysiwyg;

class FormField
{
    public static function input($name, $label)
    {
        return new Input($name, $label);
    }

    public static function textarea($name, $label)
    {
        return new Textarea($name, $label);
    }

    public static function Wysiwyg($name, $label)
    {
        return new Wysiwyg($name, $label);
    }

    public static function select($name, $label)
    {
        return new Select($name, $label);
    }

    public static function multiselect($name, $label)
    {
        return new MultiSelect($name, $label);
    }

    public static function hidden($name)
    {
        return new Hidden($name);
    }

    public static function custom($html)
    {
        return new Custom($html);
    }
}