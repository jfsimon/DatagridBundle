<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

class ContentCell extends Cell
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @see Cell
     */
    public function __toString()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
