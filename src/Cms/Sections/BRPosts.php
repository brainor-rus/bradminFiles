<?php

namespace Bradmin\Cms\Sections;

use Bradmin\Cms\Models\BRTag;
use Bradmin\Cms\Models\BRTerm;
use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;
use Illuminate\Http\Request;
use Bradmin\SectionBuilder\Meta\Meta;

class BRPosts extends Section
{
    protected $title = 'Записи';
    protected $model = 'Bradmin\Cms\Models\BRPost';

    public static function onDisplay(){
        $meta = new Meta;
        $meta->setStyles([
            '' => ''
        ])->setScripts([
            'head' => [],
            'body' => [
                'test' => asset('js/test.js')
            ]
        ]);

        $pluginsFields = app()['PluginsData']['CmsData']['Posts']['DisplayField'] ?? [];
        $brFields = [
            '0.01' => Column::text('id', '#'),
            '0.02' => Column::text('title', 'Заголовок'),
            '0.03' => Column::text('description', 'Краткое описание'),
            '0.04' => Column::text('tags.title', 'Метки'),
            '0.05' => Column::text('categories.title', 'Рубрики'),
            '0.06' => Column::text('status', 'Статус'),
            '0.07' => Column::text('created_at', 'Дата создания'),
            '0.08' => Column::text('published_at', 'Дата публикации'),
        ];

        $mergedFields = array_merge($pluginsFields, $brFields);
        ksort($mergedFields);

        $display = Display::table($mergedFields)
            ->setMeta($meta)
            ->setPagination(10);

        return $display->setScopes(['posts']);
    }

    public static function onCreate()
    {
        return self::onEdit();
    }

    public static function onEdit()
    {
        $meta = new Meta;
        $meta->setStyles([
            '' => ''
        ])->setScripts([
            'head' => [],
            'body' => [
                'test' => asset('js/test.js')
            ]
        ]);

        $pluginsFieldsLeft = app()['PluginsData']['CmsData']['Posts']['EditField']['Left'] ?? [];
        $pluginsFieldsRight = app()['PluginsData']['CmsData']['Posts']['EditField']['Right'] ?? [];

        $brFieldsLeft = [
            '0.01' => FormField::input('title', 'Заголовок')->setRequired(true),
            '0.02' => FormField::textarea('description', 'Краткое описание')->setRows(3),
            '0.03' => FormField::input('slug', 'Слаг')->setRequired(true),
            '0.04' => FormField::input('url', 'Ссылка')->setRequired(true),
            '0.05' => FormField::multiselect('tags', 'Метки')
                ->setModelForOptions(BRTag::class)
                ->setQueryFunctionForModel(
                    function ($query) {
                        return $query->tags();
                    }
                )
                ->setDisplay('title'),
            '0.06' => FormField::multiselect('categories', 'Рубрики')
                ->setModelForOptions(BRTerm::class)
                ->setQueryFunctionForModel(
                    function ($query) {
                        return $query->categories();
                    }
                )
                ->setDisplay('title'),
            '0.07' => FormField::wysiwyg('content', 'Содержимое'),
        ];
        $brFieldsRight = [
            '0.01' => FormField::select('status', 'Статус')
                ->setOptions([
                    'draft' => 'Черновик',
                    'published' => 'Опубликовано'
                ])
                ->setRequired(true),
            '0.02' => FormField::select('template', 'Шаблон'),
            '0.03' => FormField::select('comment_on', 'Комментарии')
                ->setOptions([
                    0 => 'Запрещены',
                    1 => 'Разрешены'
                ])
                ->setRequired(true),
            '0.04' => FormField::input('published_at', 'Дата публикации')->setRequired(true),
            '0.05' => FormField::input('thumb', 'Миниатюра'),
            '99.99' => FormField::hidden('type')->setValue("post"),
        ];

        $mergedFieldsLeft = array_merge($pluginsFieldsLeft, $brFieldsLeft);
        $mergedFieldsRight = array_merge($pluginsFieldsRight, $brFieldsRight);

        ksort($mergedFieldsLeft);
        ksort($mergedFieldsRight);

        $form = Form::panel([
            FormColumn::column($mergedFieldsLeft, 'col-md-8 col-12'),
            FormColumn::column($mergedFieldsRight, 'col-md-4 col-12'),
        ])->setMeta($meta);

        return $form;
    }

    public function afterSave(Request $request, $model = null)
    {
        $terms = [];
        $terms = array_merge($request->tags ?? [], $terms);
        $terms = array_merge($request->categories ?? [], $terms);
        $model->terms()->detach();
        $model->terms()->attach($terms);
    }
}