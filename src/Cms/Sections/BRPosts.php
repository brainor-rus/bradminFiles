<?php

namespace Bradmin\Cms\Sections;

use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;

class BRPosts extends Section
{
    protected $title = 'Записи';
    protected $model = 'Bradmin\Cms\Models\BRPost';

    public static function onDisplay(){
        $pluginsFields = $app['PluginsData']['CmsData']['Posts']['DisplayField'] ?? [];
        $brFields = [
            '0.01' => Column::text('id', '#'),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);
        ksort($mergedFields);

        $display = Display::table($mergedFields)->setPagination(10);

        return $display;
    }

    public static function onCreate()
    {
        return self::onEdit();
    }

    public static function onEdit()
    {
        $form = Form::panel([
            FormColumn::column([
//                FormField::select('bank_id', 'Банк')
//                    ->setModelForOptions(BrainorPayBank::class)
//                    ->setDisplay('name')
//                    ->setRequired(true),
//                FormField::input('code', 'Код')->setRequired(true),
//                FormField::textarea('text', 'Текст')->setRequired(true)->setRows(2),
            ]),
        ]);

        return $form;
    }
}