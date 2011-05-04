<?php

namespace BeSimple\DatagridBundle\Formatter;

class PriceFormatter extends DecimalFormatter implements FormatterInterface
{
    /**
     * @see Formatter
     */
    protected function configure()
    {
        parent::configure();

        $this->addOption('currency');
        $this->addOption('precision', 2);
    }

    /**
     * @see NumberFormatter
     */
    protected function formatValueDisplay(\NumberFormatter $formatter, $value)
    {
        return $formatter->formatCurrency($value, $this->getOption('currency'));
    }
}
