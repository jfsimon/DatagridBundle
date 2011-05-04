<?php

namespace BeSimple\DatagridBundle\Formatter;

class StringFormatter extends Formatter implements FormatterInterface
{
    /**
     * @see FormatterInterface
     */
    public function formatDisplay()
    {
        if (is_object($this->value) && !method_exists($this->value, '__toString')) {
            throw new FormatterException(sprintf('Object of type %s could not be converted to string.', get_class($this->value)));
        }

        if (is_array($this->value)) {
            throw new FormatterException(sprintf('Array could not be converted to string.', get_class($this->value)));
        }

        return (string)$this->value;
    }
}
