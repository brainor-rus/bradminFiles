<?php

namespace Bradmin\Cms\Sections;

use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;

class BRPages extends Section
{
    protected $title = 'Записи';
    protected $model = 'Bradmin\Cms\Models\BRPage';

    public static function onDisplay(\Illuminate\Contracts\Foundation\Application  $app){
        $pluginsFields = $app['PluginsData']['CmsData']['Pages']['DisplayField'] ?? [];
        $brFields = [
            '0.01' => Column::text('id', '#'),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);
        ksort($mergedFields);

        $display = Display::table($mergedFields)->setPagination(10);

        return $display;
    }

    public static function onEdit(\Illuminate\Contracts\Foundation\Application  $app)
    {
//        $editArrayLeft = ksort(
//            array_merge(
//                [
//                    '0.1' => FormField::input('code', 'Код')->setRequired(true),
//                ], $app['PluginsData']['CmsData']['Pages']['EditField']['Left'])
//        );
//
//        $editArrayRight = ksort(
//            array_merge(
//                [
//                    '0.1' => FormField::input('code', 'Код')->setRequired(true),
//                ], (new self)->app['PluginsData']['CmsData']['Pages']['EditField']['Right'])
//        );
//
//        $form = Form::panel([
//            FormColumn::column([
//                $editArrayLeft
//            ]),
//            FormColumn::column([
//                $editArrayRight
//            ]),
//        ]);
//
//        return $form;
    }

    public static function onCreate()
    {
        return self::onEdit();
    }
}