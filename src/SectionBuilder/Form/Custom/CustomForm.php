<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 13:04
 */

namespace Bradmin\SectionBuilder\Form\Custom;


use Bradmin\SectionBuilder\Meta\Meta;
use Bradmin\Section;

class CustomForm
{
    private $view, $meta;

    public function __construct($view)
    {
        $this->setView($view);
        $this->meta = new Meta;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
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

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     * @return CustomForm
     */
    public function setView($view): CustomForm
    {
        $this->view = $view;
        return $this;
    }

    public function render($modelPath, $sectionName, Section $firedSection, $id = null, $pluginData = null)
    {
        $model = new $modelPath();
        $view = $this->getView();

        if(isset($id))
        {
            $model = $model->where('id', $id)->first();
            if(!isset($model))
            {
                abort(404);
            }
        }

        return $view;
    }
}