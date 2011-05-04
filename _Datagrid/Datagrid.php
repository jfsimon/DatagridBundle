<?php

namespace BeSimple\DatagridBundle\Datagrid;

use BeSimple\DatagridBundle\Datasource\DatasourceInterface;
use BeSimple\DatagridBundle\Datagrid\ColumnInterface;
use BeSimple\DatagridBundle\Datagrid\RowInterface;

class Datagrid
{
    protected $datasource;
    protected $pager;
    protected $columns;

    public function __construct(DatasourceInterface $datasource)
    {
        $this->datasource = $datasource;
        $this->pager      = new DatagridPager();
        $this->columns    = new ColumnCollection();
    }

    public function getPager()
    {
        return $this->pager;
    }

    public function getRows()
    {
        return new RowCollection($this->datasource, $this->columns, $this->pager->getOffset());
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addColumn(ColumnInterface $column)
    {
        $this->columns->add($column);

        return $this;
    }

    public function removeColumn($column)
    {
        $this->columns->remove($column);

        return $this;
    }

    public function sort($key)
    {
        if (substr($key, 0, 1) === '-') {
            $asc = false;
            $key = substr($key, 1);
        } else {
            $asc = true;
        }

        $this->datasource->sort($key, $asc);

        return $this;
    }

    public function paginate($page, $length = null)
    {
        if (!is_null($length)) {
            $this->pager->setLength($length);
        }

        $this->pager->setTotalCount($this->datasource->getTotalCount());
        $this->datasource->paginate($length, $this->pager->getOffset());

        return $this;
    }
}
