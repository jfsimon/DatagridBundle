<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

class LabelCell extends Cell
{
    /**
     * @var string
     */
    protected $label;

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
}
