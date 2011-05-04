<?php

namespace BeSimple\DatagridBundle\Formatter;

abstract class NumberFormatter extends Formatter implements FormatterInterface
{
    protected $type;
    protected $attributes;

    /**
     * @see \BeSimple\DatagridBundle\Formatter\FormatterInterface
     */
    public function formatDisplay()
    {
        $formatter = $this->getFormatter();
        $value = $formatter->format($this->getValue());

        if (intl_is_failure($formatter->getErrorCode())) {
            throw new FormatterException($formatter->getErrorMessage());
        }

        return $this->formatValueDisplay($formatter, $value);
    }

    /**
     * @return \NumberFormatter
     */
    protected function getFormatter()
    {
        $formatter = new \NumberFormatter(\Locale::getDefault(), $this->type);

        $formatter->setAttribute(\NumberFormatter::GROUPING_USED, $this->getOption('grouping'));

        return $formatter;
    }

    /**
     * @see Formatter
     */
    protected function configure()
    {
        $this->type = \NumberFormatter::DECIMAL;
        $this->addOption('grouping', false);
    }

    /**
     * @param \NumberFormatter $formatter
     * @param integer|float $value
     * @return string
     */
    protected function formatValueDisplay(\NumberFormatter $formatter, $value)
    {
        return $formatter->format($value);
    }
}
