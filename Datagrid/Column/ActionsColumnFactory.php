<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datagrid\DatagridRouter;

class ActionsColumnFactory
{
    protected $router;

    public function __construct(DatagridRouter $router)
    {
        $this->router = $router;
    }

    public function createColumn(array $actions)
    {
        return new ActionsColumn($this->router, $actions);
    }
}
