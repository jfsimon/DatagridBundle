<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datasource\RowInterface;

class FieldColumn extends Column implements ColumnInterface
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $label;

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param  $field string
     * @return void
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param  $label string
     * @return void
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @see ColumnInterface
     */
    public function getHeaderCell()
    {
        $cell = $this->factory->createCell('sorter');

        $cell->setField($this->field);
        $cell->setLabel($this->label);

        return $cell;
    }

    /**
     * @see ColumnInterface
     */
    public function getBodyCell(RowInterface $row)
    {
        $cell = $this->factory->createCell('field');

        $cell->setField($this->field);
        $cell->setFormatter( /* todo: get a formatter from somewhere */);
        $cell->setRow($row);

        return $cell;
    }
}
