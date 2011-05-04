<?php

namespace BeSimple\DatagridBundle\Formatter;

class DatetimeFormatter extends Formatter implements FormatterInterface
{
    /**
     * @see FormatterInterface
     */
    public function formatDisplay()
    {
        if ($this->value instanceof \DateTime) {
            $datetime = $this->value;
        }

        else {
            try {
                $zone = $this->getOption('zone') ? new \DateTimeZone($this->getOption('zone')) : null;
                $datetime = $this->getOption('input')
                        ? \DateTime::createFromFormat($this->getOption('input'), $this->value, $zone)
                        : new \DateTime($this->value, $zone);
            }

            catch (\Exception $e) {
                throw new FormatterException($e->getMessage());
            }
        }

        return $datetime->format($this->getOption('output'));
    }

    protected function configure()
    {
        $this->addOption('zone', false);
        $this->addOption('input', false);
        $this->addOption('output', 'Y-m-d H:i:s');
    }
}
