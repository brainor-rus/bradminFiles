<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 13:36
 */

namespace Bradmin\SectionBuilder\Form\Panel\Fields;


use Illuminate\Support\Facades\View;

class DropZone
{
    private $name, $label, $id, $url;

    public function __construct($name, $label, $id, $url)
    {
        $this->setName($name);
        $this->setLabel($label);
        $this->setId($id);
        $this->setUrl($url);
    }

    /**
     * @param mixed $name
     */
    private function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $label
     */
    private function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * @param mixed $id
     */
    private function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $url
     */
    private function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function render()
    {
        $name = $this->getName();
        $label = $this->getLabel();
        $id = $this->getId();
        $url = $this->getUrl();

        return View::make('bradmin::SectionBuilder/Form/Fields/dropZone')
            ->with(compact('name', 'label','id','url'));
    }
}