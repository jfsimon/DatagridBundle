<?php

namespace BeSimple\DatagridBundle\Formatter;

class ArrayFormatter extends Formatter implements FormatterInterface
{
    /**
     * @see FormatterInterface
     */
    public function formatDisplay()
    {
        if (!is_array($this->value) || $this->value instanceof \Traversable) {
            throw new FormatterException('Value should be array or implement \Traversable.');
        }

        return implode($this->getOption('glue'), $this->value);
    }

    protected function configure()
    {
        $this->addOption('glue', ', ');
    }
}
