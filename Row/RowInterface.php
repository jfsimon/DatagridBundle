<?php

namespace BeSimple\DatagridBundle\Row;

class RowInterface
{
    /**
     * Return unique identifier for the row.
     *
     * @return string Unique identifier for the row.
     */
    public function getId();

    /**
     * Return a value for given id.
     *
     * @param string $id Unique identifier for the value.
     * @return mixed Value for given id.
     */
    public function getValue($id);

    /**
     * Is a row input (a form).
     *
     * @return boolean Is a row input.
     */
    public function getIsInput();
}