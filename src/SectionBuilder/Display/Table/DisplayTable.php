<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.10.2018
 * Time: 13:12
 */

namespace Bradmin\SectionBuilder\Display\Table;

use Bradmin\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use BRHelper;

class DisplayTable
{
    private $pagination, $columns;

    public function __construct($columns, $pagination)
    {
        $this->setPagination($pagination);
        $this->setColumns($columns);
    }

    public function render($modelPath, Section $firedSection, $pluginData = null)
    {
        $columns = $this->getColumns();
        $relationData = null;

        foreach ($columns as $column)
        {
            $exp = explode('.', $column->getName());
            if(count($exp) > 1)
            {
                $relationData[] = implode(".", array_slice($exp, 0, -1));
            }
        }

        $model = new $modelPath();

        $data = $model->when(isset($relationData), function ($query) use ($relationData) {
            $query->with($relationData);
        })->paginate($this->getPagination());
        $fields = array();

        foreach ($data as $key => $row)
        {
            foreach ($columns as $column)
            {
                $names = explode('.', $column->getName());

                $rowVal = $row;
                foreach ($names as $name)
                {
                    if(!(is_array($rowVal) || $rowVal instanceof \Countable))
                    {
                        $rowVal = $rowVal->{$name} ?? null;
                    } else
                    {
                        break;
                    }
                }

                $fields[$key][$column->getName()] = $column->render($rowVal);
            }
            $fields[$key]['brRowId'] = $row->id;
        }

        if(isset($pluginData['redirectUrl']))
        {
            $rc = new \ReflectionClass($firedSection);
            $pluginData['redirectUrl'] = strtr($pluginData['redirectUrl'], ['{sectionName}' => $rc->getShortName()]);
        }

        $response['data'] = $data;
        $response['view'] = View::make('bradmin::SectionBuilder/Display/Table/table')->with(compact('data', 'columns', 'fields', 'firedSection', 'pluginData'));

        return $response;
    }

    /**
     * @param mixed $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
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
    public function getPagination()
    {
        return $this->pagination;
    }
}