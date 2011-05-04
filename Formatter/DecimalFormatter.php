<?php

namespace BeSimple\DatagridBundle\Formatter;

class DecimalFormatter extends IntegerFormatter implements FormatterInterface
{
    const ROUND_FLOOR = \NumberFormatter::ROUND_FLOOR;
    const ROUND_DOWN = \NumberFormatter::ROUND_DOWN;
    const ROUND_HALFDOWN = \NumberFormatter::ROUND_HALFDOWN;
    const ROUND_HALFEVEN = \NumberFormatter::ROUND_HALFEVEN;
    const ROUND_HALFUP = \NumberFormatter::ROUND_HALFUP;
    const ROUND_UP = \NumberFormatter::ROUND_UP;
    const ROUND_CEILING = \NumberFormatter::ROUND_CEILING;

    /**
     * @throws FormatterException
     * @return int
     */
    protected function formatValue()
    {
        if (!is_numeric($this->value)) {
            throw new FormatterException('Value could not be converted to integer.');
        }

        return (float)$this->value;
    }

    /**
     * @see Formatter
     */
    protected function configure()
    {
        parent::configure();

        $this->addOption('precision', false);
        $this->addOption('round', self::ROUND_HALFUP);
    }
}
