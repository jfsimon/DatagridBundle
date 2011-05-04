<?php

namespace BeSimple\DatagridBundle\Formatter;

class IntegerFormatter extends NumberFormatter implements FormatterInterface
{
    /**
     * @throws FormatterException
     * @return int
     */
    protected function formatValue()
    {
        if (!is_numeric($this->value)) {
            throw new FormatterException('Value could not be converted to integer.');
        }

        return (int)$this->value;
    }
}
