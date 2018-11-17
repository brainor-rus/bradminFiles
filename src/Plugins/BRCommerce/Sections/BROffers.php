<?php

namespace Bradmin\Plugins\BRCommerce\Sections;

use Bradmin\Cms\Models\BRTag;
use Bradmin\Cms\Models\BRTerm;
use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Display\Table\DisplayTable;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;

class BROffers extends Section
{
    protected $model = 'Bradmin\Plugins\BRCommerce\Models\BROffer';
    protected $title = 'Товары';

    public static function onDisplay(){

        $display = Display::table([
            Column::text('id', '#'),
            Column::text('name', 'Название'),
            Column::text('discount', 'Скидка'),
            Column::text('price', 'Цена'),
            Column::text('category.title', 'Категория'),
            Column::text('article', 'Артикул'),
//            Column::text('producer.name', 'Производитель'),
        ])->setPagination(15);

        return $display;
    }

    public static function onEdit()
    {
        return self::onCreate();
    }

    public static function onCreate()
    {
        $form = Form::panel([
            FormColumn::column([
                FormField::input('name', 'Название')->setRequired(true),
                FormField::input('slug', 'Слаг (необязательно)'),
                FormField::Wysiwyg('description', 'Описание'),
            ]),
            FormColumn::column([
                FormField::input('price', 'Цена')->setValue(0)->setRequired(true),
                FormField::input('discount', 'Скидка (%)')->setValue(0)->setRequired(true),
                FormField::input('article', 'Артикул'),
                FormField::select('category_id', 'Категория')
                    ->setRequired(true)
                    ->setModelForOptions(BRTag::class)
                    ->setQueryFunctionForModel(function ($query) {
                        return $query->offerCategories();
                    })
                    ->setDisplay('title'),
                FormField::select('visible', 'Отображение')
                    ->setOptions([
                        0 => 'Нет',
                        1 => 'Да'
                    ])
            ])
        ]);

        return $form;
    }
}