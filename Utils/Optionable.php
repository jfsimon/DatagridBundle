<?php

namespace BeSimple\DatagridBundle\Utils;

abstract class Optionable implements OptionableInterface
{
    /**
     * @var array
     */
    private $optionValues;

    /**
     * @var array
     */
    private $optionDefaults;

    /**
     * @see OptionableInterface
     */
    public function getOptions()
    {
        return $this->optionValues;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->optionValues = $options;
    }

    /**
     * @see OptionableInterface
     */
    public function getOption($name)
    {
        return $this->optionValues[$name] ? : $this->getOptionDefault($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setOption($name, $value)
    {
        $this->optionValues[$name] = $value;
    }

    /**
     * @see OptionableInterface
     */
    public function hasOption($name)
    {
        return isset($this->optionDefaults[$name]);
    }

    /**
     * @param string $name
     * @return void
     */
    protected function addOption($name, $default = null)
    {
        $this->optionDefaults[$name] = $default;
    }

    /**
     * @throws OptionException
     * @param string|null $name
     * @return void
     */
    private function getOptionDefault($name)
    {
        if (!isset($this->optionDefaults[$name])) {
            throw new OptionException(
                'Option "%s" is not defined, available options are [%s]',
                $name, implode(', ', array_keys($this->optionDefaults))
            );
        }

        else if (is_null($this->optionDefaults[$name]) && !isset($this->optionValues[$name])) {
            throw new OptionException(
                'Option "%s" must be defined',
                $name
            );
        }

        return $this->optionDefaults[$name];
    }

    /**
     * @abstract
     * @return void
     */
    abstract protected function configure();
}
