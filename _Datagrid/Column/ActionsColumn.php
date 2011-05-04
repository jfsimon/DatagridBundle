<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datasource\RowInterface;

class IndexColumn extends Column implements ColumnInterface
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var array
     */
    protected $actions;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return void
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param array $actions
     * @return void
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * @see ColumnInterface
     */
    public function getHeaderCell()
    {
        $cell = $this->factory->createCell('label');

        $cell->setLabel($this->label);

        return $cell;
    }

    /**
     * @see ColumnInterface
     */
    public function getBodyCell(RowInterface $row)
    {
        $cell = $this->factory->createCell('actions');

        $cell->setActions($this->actions);
        $cell->setRow($row);

        return $cell;
    }
}
