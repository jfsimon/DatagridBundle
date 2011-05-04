<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

interface ColumnInterface
{
    /**
     * Return the header cell.
     *
     * @return CellInterface Header cell.
     */
    public function getHeaderCell();

    /**
     * Return a body cell.
     *
     * @param RowInterface $row
     * @return CellInterface Body cell.
     */
    public function getBodyCell(RowInterface $row);
}
