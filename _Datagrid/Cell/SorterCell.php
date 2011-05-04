<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

class SorterCell extends LabelCell
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @see Cell
     */
    public function __toString()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     * @return void
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getUrl()
    {

    }

    /**
     * @return null|string
     */
    public function getSorting()
    {
        return null;
    }
}
