<?php

namespace BeSimple\DatagridBundle\Formatter;

use BeSimple\DatagridBundle\Utils\ObjectRefection;

class ObjectFormatter extends Formatter implements FormatterInterface
{
    /**
     * @see FormatterInterface
     */
    public function formatDisplay()
    {
        if (!is_object($this->value)) {
            throw new FormatterException('Value should be an object.');
        }

        $formatter = $this->getFactory()->createByType($this->getOption('type'), $this->getOption('options'));
        $formatter->setValue(ObjectRefection::read($this->value, $this->getOption('property')));

        return $formatter->formatDisplay();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption('property');
        $this->addOption('type');
        $this->addOption('options', array());
    }
}
