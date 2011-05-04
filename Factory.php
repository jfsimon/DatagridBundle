<?php

namespace BeSimple\DatagridBundle;

class Factory
{
    protected $datasourceClasses;
    protected $columnClasses;
    protected $cellClasses;

    public function __construct(Request $request, Router $router, $datasourceClasses, $columnClasses, $cellClasses)
    {
        $this->request = $request;
        $this->router = $router;
        $this->datasourceClasses = $datasourceClasses;
        $this->columnClasses = $columnClasses;
        $this->cellClasses = $cellClasses;
    }

    public function createDatasource($type, $resource)
    {
        $class = $this->datasourceClasses[$type];
        $datasource = new $class($resource);

        return $datasource;
    }

    public function createDatagrid($type)
    {
        $datagrid = new Datagrid($this, $this->getContext($id));

        return $datagrid;
    }

    public function createDatagridColumn($type, $datagridId)
    {
        $class = $this->columnClasses[$type];
        $column = new $class($this, $this->getContext($datagridId));

        return $column;
    }

    public function createDatagridCell($type)
    {
        $class = $this->cellClasses[$type];
        $cell = new $class();

        return $cell;
    }
}
