<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

use BeSimple\DatagridBundle\Formatter\FormatterInterface;

class ValueCell extends Cell
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @see Cell
     */
    public function __toString()
    {
        return $this->formatter->formatDisplay($this->row->getValue($this->field));
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     * @return void
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return FormatterInterface
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param FormatterInterface $formatter
     * @return void
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return string
     */
    public function getDisplayValue()
    {
        $this->ensureRowObject();

        return $this->formatter->formatDisplay($this->row->getValue($this->field));
    }
}
