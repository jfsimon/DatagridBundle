<?php

namespace BeSimple\DatagridBundle\Datagrid;

class Datagrid
{
    /**
     * @var \BeSimple\DatagridBundle\Datagrid\DatagridContext
     */
    protected $context;

    /**
    * @var \BeSimple\DatagridBundle\Datagrid\DatagridRouter
    */
    protected $router;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var Datasource
     */
    protected $datasource;

    /**
     * @var array
     */
    protected $rows;

    /**
     * @param \BeSimple\DatagridBundle\Datagrid\DatagridContext
     * @param \BeSimple\DatagridBundle\Datagrid\DatagridRouter
     */
    public function __construct(DatagridContext $context, DatagridRouter $router)
    {
        $this->context    = $context;
        $this->router     = $router;
        $this->columns    = array();
        $this->datasource = null;
        $this->rows       = null;
    }

    /**
     * @return \BeSimple\DatagridBundle\Datagrid\DatagridContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param \BeSimple\DatagridBundle\Datagrid\DatagridContext $context
     * @return void
     */
    public function setContext(DatagridContext $context)
    {
        $this->rows    = null;
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     * @return void
     */
    public function setColumns(array $columns)
    {
        $this->rows    = null;
        $this->columns = $columns;
    }

    /**
     * @return \BeSimple\DatagridBundle\Datagrid\Dataset
     */
    public function getDatasource()
    {
        return $this->datasource;
    }

    /**
     * @param \BeSimple\DatagridBundle\Datagrid\Datasource $datasource
     * @return void
     */
    public function setDatasource(Datasource $datasource)
    {
        $this->rows       = null;
        $this->datasource = $datasource;
    }

    /**
     * @return \BeSimple\DatagridBundle\Datagrid\DatagridRouter
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param \BeSimple\DatagridBundle\Datagrid\DatagridRouter $router
     * @return void
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function getFields()
    {
        $fields = array();

        foreach ($this->columns as $column) {
            if ($column instanceof FieldColumnInterface) {
                $fields[] = $column->getField();
            }
        }

        return $fields;
    }

    public function getRows()
    {
        if (is_array($this->rows)) {
            return $this->rows;
        }

        if (!$this->datasource instanceof Datasource) {
            throw new \InvalidArgumentException('Datasource is not defined.');
        }

        $datesetBuilder = $this
            ->datasource
            ->getDatasetBuilder()
            ->select($this->getFields())
            ->paginate($this->context->getPageIndex(), $this->context->getPageLength())
            ->sort($this->context->getSortField(), $this->context->getSortOrder())
        ;

        foreach ($this->context->getFilters() as $filter) {
            $datesetBuilder->filter($filter);
        }

        return $this->rows = $datesetBuilder->getRows();
    }

    /**
     * @param int|null $index
     * @param int|null $length
     * @return string
     */
    public function generatePageUrl($index = null, $length = null)
    {
        return $this->router->generate(
            $index ?: $this->context->getPageIndex(),
            $length ?: $this->context->getPageLength(),
            $this->context->getSortField(),
            $this->context->getSortOrder()
        );
    }
}
