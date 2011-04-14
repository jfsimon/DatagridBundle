<?php

namespace BeSimple\DatagridBundle\Column;

use BeSimple\DatagridBundle\Row\RowInterface;

interface ColumnInterface
{
    /**
     * Return head renderer.
     *
     * @return CellRenderer Head renderer.
     */
    public function getHead();

    /**
     * Return body renderer.
     *
     * @param RowInterface $row
     * @return CellRenderer Body renderer.
     */
    public function getBody(RowInterface $row);

    /**
     * Return type of body values.
     *
     * @return string Body values type.
     */
    public function getType();
}