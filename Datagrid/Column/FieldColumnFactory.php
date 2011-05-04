<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datagrid\DatagridContext;
use BeSimple\DatagridBundle\Datagrid\DatagridRouter;

class FieldColumnFactory
{
    protected $context;
    protected $router;

    public function __construct(DatagridContext $context, DatagridRouter $router)
    {
        $this->context = $context;
        $this->router  = $router;
    }

    public function createColumn(Field $field)
    {
        return new FieldColumn($this->context, $this->router, $field);
    }
}
