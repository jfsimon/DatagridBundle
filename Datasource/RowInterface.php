<?php

namespace BeSimple\DatagridBundle\Datasource;

interface RowInterface
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
     * Is a row writable.
     *
     * @return boolean Is a writable row.
     */
    public function getIsWritable();
}
