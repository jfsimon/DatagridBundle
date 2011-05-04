<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

interface ColumnInterface
{
    /**
     * @return Cell
     */
    public function getHeaderCell();

    /**
     * @param Row $row
     * @return Cell
     */
    public function getBodyCell(Row $row);
}
