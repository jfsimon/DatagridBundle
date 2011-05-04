<?php

namespace BeSimple\DatagridBundle\Formatter;

use BeSimple\DatagridBundle\Utils\Optionable;
use BeSimple\DatagridBundle\Utils\ObjectRefection;

abstract class Formatter extends Optionable
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var FormatterFactory;
     */
    protected $factory;

    /**
     * @param FormatterFactory
     */
    public function __construct(FormatterFactory $factory)
    {
        $this->factory = $factory;
        $this->value = null;
        $this->configure();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return \BeSimple\DatagridBundle\Formatter\FormatterFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param \BeSimple\DatagridBundle\Formatter\FormatterFactory $factory
     * @return void
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
    }

    /**
     * @see FormatterInterface
     */
    public function getTypes()
    {
        return ObjectRefection::subtypeNames($this, true, true);
    }

    /**
     * @see FormatterInterface
     */
    public function getFormField()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @return void
     */
    protected function configure()
    {
    }
}
