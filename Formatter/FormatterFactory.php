<?php

namespace BeSimple\DatagridBundle\Formatter;

use Symfony\Component\DependencyInjection\ParameterBag;
use BeSimple\DatagridBundle\Utils\Optionable;
use BeSimple\DatagridBundle\Formatter\FormatterInterface;
use BeSimple\DatagridBundle\Formatter\Guesser\GuesserInterface;

class FormatterFactory
{
    const PARAMETER_NAMESPACE = 'besimple_datagrid.formatter';

    protected $parameters;
    protected $defaults;

    /**
     * @param ParameterBag $parameters
     * @param FormatGuesser $guesser
     * @return void
     */
    public function __construct(ParameterBag $parameters, array $defaults = array())
    {
        $this->parameters = $parameters;
        $this->defaults = $defaults;
    }

    /**
     * @throws FormatterException
     * @param string $type
     * @param array $options
     * @return FormatterInterface
     */
    public function createByType($type, array $options = array())
    {
        $class = $this->getFormatterClass($type);
        $formatter = new $class($this);

        $formatter->setOptions($this->resolveOptions($formatter, $options));

        return $formatter;
    }

    /**
     * @throws FormatterException
     * @param string $type
     * @return FormatterInterface
     */
    protected function getFormatterClass($type)
    {
        $parameter = sprintf('%s.class.%s', self::PARAMETER_NAMESPACE, $this->resolveAlias($type));

        if (!$this->parameters->has($parameter)) {
            throw new FormatterException(sprintf('Formatter for "%s" does not exist.', $type));
        }

        return $this->parameters->get($parameter);
    }

    /**
     * @param string $type
     * @return string
     */
    protected function resolveAlias($type)
    {
        $parameter = sprintf('%s.alias.%s', self::PARAMETER_NAMESPACE, $type);

        return $this->parameters->has($parameter) ? $this->parameters->get($parameter) : $type;
    }

    /**
     * @param FormatterInterface $formatter
     * @param array $options
     * @return array
     */
    protected function resolveOptions(FormatterInterface $formatter, array $options = array())
    {
        $defaults = array();

        foreach ($formatter->getTypes() as $type) {
            if (isset($this->defaults[$type])) {
                foreach ($this->defaults[$type] as $name => $value) {
                    if ($formatter->hasOption($name)) {
                        $defaults[$name] = $value;
                    }
                }
            }
        }

        return array_merge($defaults, $options);
    }
}
