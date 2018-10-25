<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 13:04
 */

namespace Bradmin\SectionBuilder\Form\Panel;


use Bradmin\SectionBuilder\Meta\Meta;
use Illuminate\Support\Facades\View;
use Bradmin\Section;

class PanelForm
{
    private $columns, $meta;

    public function __construct($columns)
    {
        $this->setColumns($columns);
        $this->meta = new Meta;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @param mixed $meta
     * @return DisplayTable
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public function render($modelPath, $sectionName, Section $firedSection, $id = null, $pluginData = null)
    {
        $columns = $this->getColumns();
        $model = new $modelPath();
        $action = 'create';

        if(isset($id))
        {
            $model = $model->where('id', $id)->first();
            if(!isset($model))
            {
                abort(404);
            }
            $action = 'edit';
        }

        if(isset($pluginData['redirectUrl']))
        {
            $rc = new \ReflectionClass($firedSection);
            $pluginData['redirectUrl'] = strtr($pluginData['redirectUrl'], ['{sectionName}' => $rc->getShortName()]);
        }

        $response = View::make('bradmin::SectionBuilder/Form/Panel/panel')
            ->with(compact('model', 'columns', 'sectionName', 'action', 'id', 'pluginData'));

        return $response;
    }
}