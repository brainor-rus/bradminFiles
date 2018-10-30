<?php

namespace Bradmin\Cms\Sections;

use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Display\Tiles\Columns\BaseElement\Element;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Bradmin\SectionBuilder\Meta\Meta;
use Illuminate\Http\Request;

class BRFiles extends Section
{
    protected $title = 'Файлы';
    protected $model = 'Bradmin\Cms\Models\BRFile';

    public static function onDisplay(Request $request){
        if($request->display != 'tiles') {
            $pluginsFields = app()['PluginsData']['CmsData']['Files']['DisplayField'] ?? [];
            $brFields = [
                '0.03' => Element::text('url', 'Url')->setIsHeaderImage(true, false),
//                '0.01' => Element::text('id', '#'),
//                '0.02' => Element::text('mime', 'Тип'),
//                '0.04' => Element::text('path', 'Путь на сервере'),
//                '0.05' => Element::text('size', 'Размер'),
//                '0.06' => Element::text('created_at', 'Создан'),
            ];

            $mergedFields = array_merge($pluginsFields, $brFields);
            ksort($mergedFields);

            $display = Display::tiles($mergedFields)->setPagination(10);
        } else {
            $pluginsFields = app()['PluginsData']['CmsData']['Files']['DisplayField'] ?? [];
            $brFields = [
                '0.01' => Column::text('id', '#'),
                '0.02' => Column::text('mime', 'Тип'),
                '0.03' => Column::text('url', 'Url'),
                '0.04' => Column::text('path', 'Путь на сервере'),
                '0.05' => Column::text('size', 'Размер'),
                '0.06' => Column::text('created_at', 'Создан'),
            ];

            $mergedFields = array_merge($pluginsFields, $brFields);
            ksort($mergedFields);

            $display = Display::table($mergedFields)->setPagination(10);
        }

        return $display;
    }

    public static function onCreate()
    {
        return self::onEdit();
    }

    public static function onEdit()
    {
        $pluginsFields = app()['PluginsData']['CmsData']['Tags']['Files'] ?? [];

        $brFields = [
            // todo
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);

        ksort($mergedFields);

        $form = Form::panel([
            FormColumn::column($mergedFields),
        ]);

        return $form;
    }
}