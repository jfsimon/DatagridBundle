<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datasource\RowInterface;

class CustomColumn extends Column implements ColumnInterface
{
    /**
     * @var Cell
     */
    protected $headerCell;

    /**
     * @var Cell
     */
    protected $bodyCell;

    /**
     * @see ColumnInterface
     */
    public function getHeaderCell()
    {
        return $this->headerCell;
    }

    /**
     * @param Cell $headerCell
     * @return void
     */
    public function setHeaderCell($headerCell)
    {
        $this->headerCell = $headerCell;
    }

    /**
     * @see ColumnInterface
     */
    public function getBodyCell(RowInterface $row)
    {
        $this->bodyCell->setRow($row);

        return $this->bodyCell;
    }

    /**
     * @param Cell $bodyCell
     * @return void
     */
    public function setBodyCell($bodyCell)
    {
        $this->bodyCell = $bodyCell;
    }
}
