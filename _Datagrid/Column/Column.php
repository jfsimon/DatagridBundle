<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

abstract class Column
{
    /**
     * @var DatagridContext
     */
    protected $context;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param CellRendererFactory $rendererFactory
     * @param array $options
     */
    public function __construct(DatagridContext $context, array $options)
    {
        $this->context = $context;
        $this->options = $options;
    }

    /**
     * @return DatagridContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param DatagridContext $context
     * @return void
     */
    public function setContext(DatagridContext $context)
    {
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getOption($name)
    {
        return $this->options[$name];
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }
}
