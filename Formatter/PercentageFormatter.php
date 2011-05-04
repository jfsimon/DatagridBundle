<?php

namespace BeSimple\DatagridBundle\Formatter;

class PercentageFormatter extends DecimalFormatter implements FormatterInterface
{
    /**
     * @see Formatter
     */
    protected function configure()
    {
        parent::configure();

        $this->type = \NumberFormatter::PERCENT;
    }
}
