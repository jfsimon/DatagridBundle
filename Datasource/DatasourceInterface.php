<?php

namespace BeSimple\DatagridBundle\Datasource;

use BeSimple\DatagridBundle\Row\RowsInterface;

interface DatasourceInterface
{
    /**
     * Return rows.
     *
     * @return RowsInterface Rows.
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
     * @return DatasourceInterface Return $this for chaining.
     */
    public function filter($callback);

    /**
     * Sort rows.
     *
     * @param string $key Sorting key.
     * @return DatasourceInterface Return $this for chaining.
     */
    public function sort($key);

    /**
     * Paginate rows.
     *
     * @param int $length Rows count.
     * @param int $offset First row index.
     * @return DatasourceInterface Return $this for chaining.
     */
    public function paginate($length, $offset = 0);
}