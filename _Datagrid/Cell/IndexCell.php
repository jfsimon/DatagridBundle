<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

class IndexCell extends Cell
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
     * @see Cell
     */
    public function __toString()
    {
        return (string)$this->getIndex();
    }

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
     * @return int
     */
    public function getIndex()
    {
        $this->ensureRowObject();

        return $this->row->getIndex() + 1;
    }

    public function getId()
    {
        $this->ensureRowObject();

        return $this->row->getId();
    }
}
