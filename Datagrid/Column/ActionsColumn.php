<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datagrid\DatagridRouter;

class ActionsColumn implements ColumnInterface
{
    protected $router;
    protected $actions;

    public function __construct(DatagridRouter $router, array $actions)
    {
        $this->router  = $router;
        $this->actions = $actions;
    }

    public function getHeaderCell()
    {
        return new LabelCell('actions');
    }

    public function getBodyCell(Row $row)
    {
        return new ActionsCell($this->router, $this->actions, $row);
    }
}
