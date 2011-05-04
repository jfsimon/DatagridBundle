<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

abstract class Cell
{
    /**
     * @var RowInterface
     */
    protected $row;

    /**
     * @return string
     */
    abstract public function __toString();

    /**
     * @param RowInterface $row
     * @return void
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    protected function ensureRowObject()
    {
        if (!$this->row instanceof RowInterface) {
            throw new \InvalidArgumentException(sprintf('%s row property should be a RowInterface object.', get_class($this)));
        }
    }
}
