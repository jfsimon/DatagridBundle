<?php

namespace BeSimple\DatagridBundle\Datasource;

interface DatasourceInterface
{
    /**
     * Return rows.
     *
     * @return RowCollection Rows.
     */
    public function getRows();

    /**
     * Return total rows count (without pagination parameters).
     *
     * @return int Total rows count.
     */
    public function getTotalCount();

    /**
     * Filter rows.
     *
     * @param \Closure|array $callback
     */
    public function filter($callback);

    /**
     * Sort rows.
     *
     * @param string $key Sorting key.
     */
    public function sort($key, $asc = true);

    /**
     * Paginate rows.
     *
     * @param int $length Rows count.
     * @param int $offset First row index.
     */
    public function paginate($length, $offset = 0);
}
