<?php

namespace Bradmin\Cms\Sections;

use Bradmin\Cms\Models\BRFile;
use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Display\Tiles\Columns\BaseElement\Element;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Bradmin\SectionBuilder\Meta\Meta;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BRFiles extends Section
{
    protected $title = 'Файлы';
    protected $model = 'Bradmin\Cms\Models\BRFile';

    public static function onDisplay(Request $request){
        if($request->get('display') == 'table') {
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
        } else {
            $pluginsFields = app()['PluginsData']['CmsData']['Files']['DisplayField'] ?? [];
            $brFields = [
                '0.01' => Element::text('url', 'Url')->setIsHeaderImage(true, false),
//                '0.01' => Element::text('id', '#'),
//                '0.02' => Element::text('mime', 'Тип'),
//                '0.04' => Element::text('path', 'Путь на сервере'),
//                '0.05' => Element::text('size', 'Размер'),
//                '0.06' => Element::text('created_at', 'Создан'),
            ];

            $mergedFields = array_merge($pluginsFields, $brFields);
            ksort($mergedFields);

            $display = Display::tiles($mergedFields)->setPagination(10);
        }

        $display->setNav(view('bradmin::cms.partials.filesNav'));

        return $display;
    }

    public static function onCreate()
    {
        return self::onEdit(null);
    }

    public static function onEdit($id)
    {
        $pluginsFieldsLeft = app()['PluginsData']['CmsData']['Tags']['Files']['Edit']['Left'] ?? [];
        $pluginsFieldsRight = app()['PluginsData']['CmsData']['Tags']['Files']['Edit']['Right'] ?? [];
        $file = BRFile::where('id', $id)->first();

        $brFieldsLeft = [
            "0.01" => FormField::input('title', 'Заголовок'),
            "0.02" => FormField::input('alt', 'Alt (для изображений)'),
            "0.03" => FormField::textarea('description', 'Описание'),
            "9.94" => FormField::hidden('mime')->setValue('.'),
            "9.95" => FormField::hidden('url')->setValue('.'),
            "9.96" => FormField::hidden('base_url')->setValue('.'),
            "9.97" => FormField::hidden('size')->setValue(0),
            "9.98" => FormField::hidden('extension')->setValue('.'),
            "9.99" => FormField::hidden('path')->setValue('.'),
        ];

        if($file) {
            $brFieldsRight = [
                "0.01" => FormField::custom(view('bradmin::cms.partials.filesInput')->with(compact('file'))),
            ];
        } else {
            $brFieldsRight = [
                "0.01" => FormField::custom(view('bradmin::cms.partials.filesInput')->with(compact('file'))),
                "0.02" => FormField::dropZone(
                    'dropzone_files',
                    'Выберите файл',
                    'dropzone',
                    '/'.config('bradmin.admin_url').'/cms/files/upload'
                )
            ];
        }


        $mergedFieldsLeft = array_merge($pluginsFieldsLeft, $brFieldsLeft);
        $mergedFieldsRight = array_merge($pluginsFieldsRight, $brFieldsRight);

        ksort($mergedFieldsLeft);
        ksort($mergedFieldsRight);

        $form = Form::panel([
            FormColumn::column($mergedFieldsLeft, 'col-lg-9 col-md-8 col-12'),
            FormColumn::column($mergedFieldsRight, 'col'),
        ]);

        return $form;
    }

    public function afterSave(Request $request, $model = null)
    {
        // todo Тут нужно сделать сохранение документа.
        // После загрузки документа нужно обновить поля в модели.
    }
}