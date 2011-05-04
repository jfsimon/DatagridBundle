<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datasource\RowInterface;

class IndexColumn extends Column implements ColumnInterface
{
    /**
     * @var boolean
     */
    protected $hasIndex;

    /**
     * @var boolean
     */
    protected $hasSelector;

    /**
     * @return boolean
     */
    public function getHasIndex()
    {
        return $this->hasIndex;
    }

    /**
     * @param boolean $hasIndex
     * @return void
     */
    public function setHasIndex($hasIndex)
    {
        $this->hasIndex = $hasIndex;
    }

    /**
     * @return boolean
     */
    public function getHasSelector()
    {
        return $this->hasSelector;
    }

    /**
     * @param boolean $hasSelector
     * @return void
     */
    public function setHasSelector($hasSelector)
    {
        $this->hasSelector = $hasSelector;
    }

    /**
     * @see ColumnInterface
     */
    public function getHeaderCell()
    {
        return $this->factory->createCell('empty');
    }

    /**
     * @see ColumnInterface
     */
    public function getBodyCell(RowInterface $row)
    {
        $cell = $this->factory->createCell('index');

        $cell->setHasIndex($this->hasIndex);
        $cell->setHasSelector($this->hasSelector);
        $cell->setRow($row);

        return $cell;
    }
}
