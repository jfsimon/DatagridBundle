<?php

namespace BeSimple\DatagridBundle\Formatter;

class BooleanFormatter extends Formatter implements FormatterInterface
{
    /**
     * @see FormatterInterface
     */
    public function formatDisplay()
    {
        return $this->value ? $this->getOption('true') : $this->getOption('false');
    }

    protected function configure()
    {
        $this->addOption('true', 'OK');
        $this->addOption('false', '-');
    }
}
