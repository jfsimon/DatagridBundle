<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

interface FieldColumnInterface extends ColumnInterface
{
    /**
     * @return Field
     */
    public function getField();
}
